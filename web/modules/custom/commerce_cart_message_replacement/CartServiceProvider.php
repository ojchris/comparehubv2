namespace Drupal\commerce_cart_message_replacement;

use Drupal\Core\DependencyInjection\ContainerBuilder;
use Drupal\Core\DependencyInjection\ServiceProviderBase;
use Symfony\Component\DependencyInjection\Reference;

/**
 * Replaces the add to cart message.
 */
class CommerceCartMessageReplacementServiceProvider extends ServiceProviderBase {

  /**
   * {@inheritdoc}
   */
  public function alter(ContainerBuilder $container) {
    // Replace the server side add to cart messaging.
    if ($container->hasDefinition('commerce_cart.cart_subscriber')) {
      $definition = $container->getDefinition('commerce_cart.cart_subscriber');
      $definition->setClass('Drupal\change_commerce_cart_message\EventSubscriber\CartEventSubscriber')
        ->addArgument(new Reference('request_stack'));
    }
  }

}