<?php declare(strict_types = 1);

namespace Drupal\commerce_cart_message_replacement\EventSubscriber;

use Drupal\commerce_cart\Event\CartEntityAddEvent;
use Drupal\commerce_cart\EventSubscriber\CartEventSubscriber as CommerceCartEventSubscriber;
use Drupal\Core\Messenger\MessengerInterface;
use Drupal\Core\StringTranslation\TranslationInterface;
use Symfony\Component\HttpFoundation\RequestStack;

/**
 * Replaces the original CartEventSubscriber from commerce_cart module.
 */
class CartEventSubscriber extends CommerceCartEventSubscriber {

  /**
   * The current request.
   *
   * @var \Symfony\Component\HttpFoundation\Request
   */
  protected $currentRequest;

  /**
   * Constructs a new CartEventSubscriber object.
   *
   * @param \Drupal\Core\Messenger\MessengerInterface $messenger
   *   The messenger.
   * @param \Drupal\Core\StringTranslation\TranslationInterface $string_translation
   *   The string translation.
   */
  public function __construct(MessengerInterface $messenger, TranslationInterface $string_translation, RequestStack $request_stack) {
    parent::__construct($messenger, $string_translation);

    $this->currentRequest = $request_stack->getCurrentRequest();
  }

  /**
   * {@inheritdoc}
   */
  public function displayAddToCartMessage(CartEntityAddEvent $event) {
    $is_ajax = $this->currentRequest->isXmlHttpRequest();
    if ($is_ajax) {
      $this->messenger->addMessage($this->t('@entity added to your compare cart. <a href=":url">See compare cart</a>.', [
        '@entity' => $event->getEntity()->label(),
        ':url' => Url::fromRoute('commerce_cart.page')->toString(),
      ]));
    }
  }

}
