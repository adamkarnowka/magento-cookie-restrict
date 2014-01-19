<?php
/**
 * User: Adam Karnowka
 * Date: 09.01.14
 * Time: 12:35
 */

/**
 * Overriding Core block for adding timestamp to CSS / JS files in <head> section
 * Class Creativestyle_Dev_Block_Page_Html_Head
 */
class Creativestyle_Dev_Block_Page_Html_Head extends Mage_Page_Block_Html_Head {
    public function getCssJsHtml()
    {
        // Separate items by types
        $lines  = array();
        foreach ($this->_data['items'] as $item) {
            if (!is_null($item['cond']) && !$this->getData($item['cond']) || !isset($item['name'])) {
                continue;
            }
            $if     = !empty($item['if']) ? $item['if'] : '';
            $params = !empty($item['params']) ? $item['params'] : '';
            switch ($item['type']) {
                case 'js':        // js/*.js
                case 'skin_js':   // skin/*/*.js
                case 'js_css':    // js/*.css
                case 'skin_css':  // skin/*/*.css
                    $lines[$if][$item['type']][$params][$item['name']] = $item['name'];
                    break;
                default:
                    $this->_separateOtherHtmlHeadElements($lines, $if, $item['type'], $params, $item['name'], $item);
                    break;
            }
        }

        // prepare HTML
        $shouldMergeJs = Mage::getStoreConfigFlag('dev/js/merge_files');
        $shouldMergeCss = Mage::getStoreConfigFlag('dev/css/merge_css_files');
        $html   = '';
        foreach ($lines as $if => $items) {
            if (empty($items)) {
                continue;
            }
            if (!empty($if)) {
                $html .= '<!--[if '.$if.']>'."\n";
            }

            // static and skin css
            if(Mage::getStoreConfig('dev/csoptions/css_timestamp_enabled')){
                $placeHolder = '<link rel="stylesheet" type="text/css" href="%s?uniqueTimestamp='.time().'"%s />';
            } else {
                $placeHolder = '<link rel="stylesheet" type="text/css" href="%s"%s />';
            }

            $html .= $this->_prepareStaticAndSkinElements($placeHolder."\n",
                empty($items['js_css']) ? array() : $items['js_css'],
                empty($items['skin_css']) ? array() : $items['skin_css'],
                $shouldMergeCss ? array(Mage::getDesign(), 'getMergedCssUrl') : null
            );

            // static and skin javascripts
            if(Mage::getStoreConfig('dev/csoptions/css_timestamp_enabled')){
                $jsPlaceholder = '<script type="text/javascript" src="%s?uniqueTimestamp='.time().'"%s></script>';
            } else {
                $jsPlaceholder = '<script type="text/javascript" src="%s"%s></script>';
            }

            $html .= $this->_prepareStaticAndSkinElements($jsPlaceholder. "\n",
                empty($items['js']) ? array() : $items['js'],
                empty($items['skin_js']) ? array() : $items['skin_js'],
                $shouldMergeJs ? array(Mage::getDesign(), 'getMergedJsUrl') : null
            );

            // other stuff
            if (!empty($items['other'])) {
                $html .= $this->_prepareOtherHtmlHeadElements($items['other']) . "\n";
            }

            if (!empty($if)) {
                $html .= '<![endif]-->'."\n";
            }
        }
        return $html;
    }
}