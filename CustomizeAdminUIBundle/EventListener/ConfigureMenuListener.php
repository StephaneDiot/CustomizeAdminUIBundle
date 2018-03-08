<?php
namespace EzSystems\CustomizeAdminUIBundle\EventListener;
use EzSystems\EzPlatformAdminUi\Menu\Event\ConfigureMenuEvent;
use EzSystems\EzPlatformAdminUi\Menu\MainMenuBuilder;
use JMS\TranslationBundle\Translation\TranslationContainerInterface;
use JMS\TranslationBundle\Model\Message;
class ConfigureMenuListener implements TranslationContainerInterface
{
    const CUSTOM__MENU__ITEM = 'custom__menu__item';
    /**
     * @param ConfigureMenuEvent $event
     */
    public function onMenuConfigure(ConfigureMenuEvent $event)
    {
        $menu = $event->getMenu();
        $contentMenu = $menu->getChild(MainMenuBuilder::ITEM_CONTENT);
        $contentMenu->addChild(self::CUSTOM__MENU__ITEM, ['route' => 'ezsystems.custompage.menu']);


    }
    /**
     * @return array
     */
    public static function getTranslationMessages(): array
    {
        return [
            (new Message(self::CUSTOM__MENU__ITEM, 'messages'))->setDesc('Customized menu item'),
        ];
    }
}
