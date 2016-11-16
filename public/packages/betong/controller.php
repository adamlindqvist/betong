<?php
namespace Concrete\Package\Betong;

use BlockType;
use BlockTypeSet;
use CollectionAttributeKey;
use CollectionType;
use Concrete\Core\Attribute\Key\Category as AttributeKeyCategory;
use Concrete\Core\Attribute\Key\CollectionKey as CollectionKey;
use Concrete\Core\Attribute\Set as AttributeSet;
use Concrete\Core\File\Set\Set;
use Concrete\Core\Page\Page;
use Concrete\Core\Page\Single as SinglePage;
use Concrete\Core\Page\Template as PageTemplate;
use Concrete\Core\Page\Type\Composer\Control\CollectionAttributeControl as AttributeControl;
use Concrete\Core\Page\Type\Composer\Control\Control;
use Concrete\Core\Page\Type\Composer\Control\CorePageProperty\CorePageProperty;
use Concrete\Core\Page\Type\Composer\Control\CorePageProperty\DescriptionCorePageProperty;
use Concrete\Core\Page\Type\Composer\Control\CorePageProperty\NameCorePageProperty;
use Concrete\Core\Page\Type\Composer\Control\CorePageProperty\PageTemplateCorePageProperty;
use Concrete\Core\Page\Type\Composer\Control\CorePageProperty\PublishTargetCorePageProperty;
use Concrete\Core\Page\Type\Composer\Control\CorePageProperty\UrlSlugCorePageProperty;
use Concrete\Core\Page\Type\Composer\Control\Type\BlockType as ComposerBlockType;
use Concrete\Core\Page\Type\Composer\FormLayoutSet;
use Concrete\Core\Page\Type\Composer\FormLayoutSetControl;
use Concrete\Core\Page\Type\Type as PageType;
use  \Concrete\Core\Package\Package as Package;
use Exception;
use Loader;
use Route;

class Controller extends Package
{
    protected $pkgHandle = 'betong';
    protected $appVersionRequired = '5.7.5.9';
    protected $pkgVersion = '0.0.1';
    private $blockTypeSetHandle = 'betong';

    private $blockTypeSetName = 'betong';

    public function on_start()
    {
        // Register custom routes CMS boot up.
        $this->registerRoutes();
    }

    public function getPackageDescription()
    {
        return t("Betong boilerplate package");
    }

    public function getPackageName()
    {
        return t("Betong");
    }

    /**
     * The packages install routine.
     *
     * @return void
     */
    public function install()
    {
        $pkg = parent::install();

        $this->installOrUpgrade($pkg);
    }

    /**
     * The packages upgrade routine.
     *
     * @return void
     */
    public function upgrade()
    {
        parent::upgrade();

        $pkg = Package::getByHandle($this->pkgHandle);

        $this->installOrUpgrade($pkg);
    }

    /**
     * The packages uninstall routine.
     *
     * @return void
     */
    public function uninstall()
    {
        // Add your custom logic here that needs to be executed BEFORE package uninstall.
        parent::uninstall();
        // Add your custom logic here that needs to be executed AFTER package uninstall.
    }

    /**
     * Install or upgrade all custom package installs.
     *
     * @param $pkg Package
     */
    private function installOrUpgrade($pkg)
    {
        $this->installAttributes($pkg);
        $this->installBlockTypeSet($pkg);
        $this->installBlockTypes($pkg);
        $this->installPageTemplates($pkg);
        $this->installPageTypes($pkg);
        $this->installComposerFields($pkg);
        $this->installPages($pkg);
        $this->installFileSets($pkg);
    }

    /**
     * Install custom block types.
     *
     * @param $pkg Package
     */
    private function installBlockTypes($pkg)
    {
        //$this->installBlockType('hero', $pkg);
    }

    /**
     * Install custom page types.
     *
     * @param $pkg Package
     */
    public function installPageTypes($pkg)
    {
        //$this->installPageType('custom_page_type_handle', 'Custom page type name', true, 'default', $pkg);
    }

    /**
     * Install custom attributes.
     *
     * @param $pkg Package
     */
    public function installAttributes($pkg)
    {
        $attributeSet = $this->installAttributeSet($pkg);

        //$this->installImageAttribute($pkg, $attributeSet, 'header_image', 'Header image');
    }

    /**
     *  Install custom pages.
     *
     * @param $pkg Package
     */
    private function installPages($pkg)
    {
        //SinglePage::add('/dashboard/custom_dashboard_page/', $pkg);
    }

    /**
     * Install custom page templates.
     *
     * @param $pkg Package
     */
    private function installPageTemplates($pkg)
    {
        //$this->installPageTemplate('page_startpage', 'Startpage', $pkg);
    }

    /**
     * Register custom routes to a specific controller and action.
     */
    private function registerRoutes()
    {
        //Route::register('/url',
        //    '\Concrete\Package\Betong\Controller\controller::action'
        //);
    }

    /**
     * Defines which composer fields to install.
     *
     * @param $pkg Package
     */
    private function installComposerFields($pkg)
    {
        //$this->installComposerField($pkg);
    }

    /**
     * Install and attach a composer field to a page type.
     * Duplicate this function to add other custom composer fields.
     *
     * @param $pkg Package
     */
    private function installComposerField($pkg)
    {
        // $pt = PageType::getByHandle('page_type_handle');
        // $formData = $this->addBasicFields($pt);
        // $set = $formData["set"];
        // $composerField = $this->getComposerCustomAttribute('custom_attribute_handle');
        // $composerFieldControl = $this->addFormControl($set, $composerField, 'Composer field label');
    }

    /**
     * Install custom filesets.
     *
     * @param $pkg Package
     */
    private function installFileSets($pkg)
    {
        //$this->installFileSet('Images');
    }
    
    /*
    |--------------------------------------------------------------------------
    | Controller helper functions.
    |--------------------------------------------------------------------------
    |
    | Beneath is the helper functions to make the custom installs
    | above possible.
    |
    */

    private function installBlockType($blockTypeHandle, $pkg)
    {
        $bt = BlockType::getByHandle($blockTypeHandle);
        if (!is_object($bt)) {
            $bt = BlockType::installBlockType($blockTypeHandle, $pkg);
        }
        $blockTypeSet = BlockTypeSet::getByHandle($this->blockTypeSetHandle);
        $blockTypeSet->addBlockType($bt);
    }

    private function installAttributeSet($pkg)
    {
        $attributeKeyCategory = AttributeKeyCategory::getByHandle('collection');

        $attributeKeyCategory->setAllowAttributeSets(AttributeKeyCategory::ASET_ALLOW_SINGLE);
        $attributeSet = AttributeSet::getByHandle($this->pkgHandle);
        if (!is_object($attributeSet)) {
            $attributeSet = $attributeKeyCategory->addSet($this->pkgHandle, $this->getPackageName(), $pkg);
        }

        return $attributeSet;
    }

    private function installImageAttribute($pkg, $attributeSet, $handle, $name)
    {
        $imageKey = CollectionAttributeKey::getByHandle($handle);
        if (!$imageKey || !intval($imageKey)) {
            $imageKey = CollectionAttributeKey::add('image_file', array(
                'akHandle'              => $handle,
                'akName'                => $name,
                'akIsSearchable'        => false,
                'akIsSearchableIndexed' => false,
                'akTextareaDisplayMode' => 'rich_text'
            ), $pkg);
            $imageKey->setAttributeSet($attributeSet);
        }
    }

    private function installTextareaAttribute($pkg, $attributeSet, $handle, $name)
    {
        $textareaKey = CollectionAttributeKey::getByHandle($handle);
        if (!$textareaKey || !intval($textareaKey)) {
            $textareaKey = CollectionAttributeKey::add('textarea', array(
                'akHandle'              => $handle,
                'akName'                => $name,
                'akIsSearchable'        => true,
                'akIsSearchableIndexed' => true,
                'akTextareaDisplayMode' => 'rich_text'
            ), $pkg);
            $textareaKey->setAttributeSet($attributeSet);
        }
    }

    private function installTextAttribute($pkg, $attributeSet, $handle, $name)
    {
        $textareaKey = CollectionAttributeKey::getByHandle($handle);
        if (!$textareaKey || !intval($textareaKey)) {
            $textareaKey = CollectionAttributeKey::add('text', array(
                'akHandle'              => $handle,
                'akName'                => $name,
                'akIsSearchable'        => true,
                'akIsSearchableIndexed' => true,
                'akTextareaDisplayMode' => 'text'
            ), $pkg);
            $textareaKey->setAttributeSet($attributeSet);
        }
    }

    private function installFileAttribute($pkg, $attributeSet, $handle, $name)
    {
        $textareaKey = CollectionAttributeKey::getByHandle($handle);
        if (!$textareaKey || !intval($textareaKey)) {
            $textareaKey = CollectionAttributeKey::add('image_file', array(
                'akHandle'              => $handle,
                'akName'                => $name,
                'akIsSearchable'        => true,
                'akIsSearchableIndexed' => true
            ), $pkg);
            $textareaKey->setAttributeSet($attributeSet);
        }
    }

    private function installTopicsAttribute($pkg, $attributeSet, $handle, $name)
    {
        $textareaKey = CollectionAttributeKey::getByHandle($handle);
        if (!$textareaKey || !intval($textareaKey)) {
            $textareaKey = CollectionAttributeKey::add('topics', array(
                'akHandle'              => $handle,
                'akName'                => $name,
                'akIsSearchable'        => true,
                'akIsSearchableIndexed' => true,
            ), $pkg);
            $textareaKey->setAttributeSet($attributeSet);
        }
    }

    private function installPage($name, $handle, $location, $pageTypeHandle, $pageThemeHandle)
    {
        $parentPage = null;
        if ($location) {
            $parentPage = Page::getByPath($location);
        }
        else {
            $location = '';
            $parentPage = Page::getByID(1);
        }

        $page = Page::getByPath($location . ' / ' . $handle);
        if ($page->getCollectionID()) { // already installed
            return;
        }
        $pageType = PageType::getByHandle($pageTypeHandle);
        $template = PageTemplate::getByHandle($pageThemeHandle);

        if ($pageType == null) {
            throw new Exception('Sidtyp med handtag ' . $pageTypeHandle . ' saknas!');
        }
        if ($template == null) {
            throw new Exception('Sidtema med handtag ' . $pageThemeHandle . ' saknas!');
        }

        $parentPage->add($pageType, array(
            'cName'   => $name,
            'cHandle' => $handle
        ), $template);
    }

    private function installBlockTypeSet($pkg)
    {
        if (!is_object(BlockTypeSet::getByHandle($this->blockTypeSetHandle))) {
            BlockTypeSet::add($this->blockTypeSetHandle, $this->blockTypeSetName, $pkg);
        }
    }

    public function installPageType($handle, $name, $composer = false, $page_template = 'full', $pkg)
    {
        $data = array();
        $data['handle'] = $handle;
        $data['name'] = $name;
        $data['ptLaunchInComposer'] = $composer;
        $data['allowedTemplates'] = false;
        $data['defaultTemplate'] = PageTemplate::getByHandle($page_template);

        if (!PageType::getByHandle($handle)) {
            PageType::add($data, $pkg);
            $this->addBasicFields(PageType::getByHandle($handle));
        }
    }

    private function installPageTemplate($handle, $name, $pkg)
    {
        $template = PageTemplate::getByHandle($handle);
        if (!$template) {
            PageTemplate::add($handle, $name, FILENAME_PAGE_TEMPLATE_DEFAULT_ICON, $pkg);
        }
    }

    private function addBasicFields(PageType $pt, $setName = "Basics")
    {
        /* @var FormLayoutSet $set */
        $set = $this->addComposerLayoutSet($pt, $setName, "");
        $added = $this->addFormControl($set, new NameCorePageProperty(), "Page Name");
        $added->updateFormLayoutSetControlRequired(true);

        return [
            "set"            => $set,
            "name"           => $added,
            "description"    => $this->addFormControl($set, new DescriptionCorePageProperty()),
            "url_slug"       => $this->addFormControl($set, new UrlSlugCorePageProperty()),
            "publish_target" => $this->addFormControl($set, new PublishTargetCorePageProperty()),
            "page_template"  => $this->addFormControl($set, new PageTemplateCorePageProperty())
        ];
    }

    private function getComposerBlock($handle)
    {
        return (new ComposerBlockType())->configureFromImportHandle($handle);
    }

    private function getComposerCustomAttribute($handle)
    {
        $attributeControl = new AttributeControl();
        $attributeKeyID = CollectionKey::getByHandle($handle)->getAttributeKeyID();
        $attributeControl->setAttributeKeyID($attributeKeyID);

        return $attributeControl;
    }

    /**
     * @param PageType $pageType
     * @param $name
     * @param string $desc
     * @return FormLayoutSet
     */
    private function addComposerLayoutSet(PageType $pageType, $name = "", $desc = "")
    {
        $layouts = FormLayoutSet::getList($pageType);
        $layout = array_filter($layouts, function ($item) use ($name) {
            /* @var FormLayoutSet $item */
            return ($item->getPageTypeComposerFormLayoutSetName() == $name);
        });

        return (count($layout) > 0) ? $layout[0] : $pageType->addPageTypeComposerFormLayoutSet($name, $desc);
    }

    /**
     * @param FormLayoutSet $set
     * @param CorePageProperty $controlType
     * @param $name
     * @param string $desc
     * @return FormLayoutSetControl
     */
    private function addFormControl(FormLayoutSet $set, Control $controlType, $name = "", $desc = "")
    {
        $controls = FormLayoutSetControl::getList($set);
        $control = array_values(array_filter($controls, function ($item) use ($name, $controlType) {
            /* @var FormLayoutSetControl $item */
            if (trim($name) != "") {
                return ($item->getPageTypeComposerFormLayoutSetControlCustomLabel() == $name);
            }
            else {
                return ($item->getPageTypeComposerControlObject()->getPageTypeComposerControlIdentifier() == $controlType->getPageTypeComposerControlIdentifier());

            }
        }));

        $control = (count($control) > 0) ? $control[0] : $controlType->addToPageTypeComposerFormLayoutSet($set);
        if ($name != "")
            $control->updateFormLayoutSetControlCustomLabel($name);
        if ($desc != "")
            $control->updateFormLayoutSetControlDescription($desc);

        return $control;
    }

    private function installFileSet($name)
    {
        return Set::createAndGetSet(
            $name,
            Set::TYPE_PUBLIC
        );
    }
}