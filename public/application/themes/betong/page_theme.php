<?php

namespace Application\Theme\Betong;

use Concrete\Core\Area\Layout\Preset\Provider\ThemeProviderInterface;

class PageTheme extends \Concrete\Core\Page\Theme\Theme implements ThemeProviderInterface
{

    public function registerAssets()
    {
        $this->requireAsset('javascript', 'jquery');
        $this->providesAsset('javascript', 'bootstrap/*');
        // $this->providesAsset('css', 'bootstrap/*');
        // $this->providesAsset('css', 'core/frontend/*');
        // $this->requireAsset('css', 'font-awesome');
        // $this->requireAsset('javascript', 'picturefill');
        // $this->requireAsset('javascript-conditional', 'html5-shiv');
        // $this->requireAsset('javascript-conditional', 'respond');
    }

    protected $pThemeGridFrameworkHandle = 'bootstrap3';

    public function getThemeName()
    {
        return t('Betong');
    }

    public function getThemeDescription()
    {
        return t('Betong Concrete5 boilerplate');
    }

    public function getThemeBlockClasses()
    {

    }

    public function getThemeAreaClasses()
    {

    }

    public function getThemeDefaultBlockTemplates()
    {

    }

    public function getThemeResponsiveImageMap()
    {
        return array(
            'large'  => '900px',
            'medium' => '768px',
            'small'  => '0',
        );
    }

    public function getThemeEditorClasses()
    {
        return array(
            array('title' => t('Orange Button'), 'menuClass' => '', 'spanClass' => 'btn btn-orange', 'forceBlock' => '1'),
        );
    }

    public function getThemeAreaLayoutPresets()
    {
        $presets = array(
            array(
                'handle'    => 'left_sidebar',
                'name'      => 'Left Sidebar',
                'container' => '<div class="row"></div>',
                'columns'   => array(
                    '<div class="col-sm-4"></div>',
                    '<div class="col-sm-8"></div>'
                ),
            ),
            array(
                'handle'    => 'right_sidebar',
                'name'      => 'Right Sidebar',
                'container' => '<div class="row"></div>',
                'columns'   => array(
                    '<div class="col-sm-8"></div>',
                    '<div class="col-sm-4"></div>'
                ),
            )
        );

        return $presets;
    }
}
