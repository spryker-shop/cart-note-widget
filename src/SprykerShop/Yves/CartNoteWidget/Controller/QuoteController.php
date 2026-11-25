<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerShop\Yves\CartNoteWidget\Controller;

use Generated\Shared\Transfer\QuoteResponseTransfer;
use Spryker\Shared\CartNote\Code\Messages;
use SprykerShop\Yves\CartNoteWidget\Form\QuoteCartNoteForm;
use Symfony\Component\HttpFoundation\Request;

/**
 * @method \SprykerShop\Yves\CartNoteWidget\CartNoteWidgetFactory getFactory()
 */
class QuoteController extends AbstractCartNoteController
{
    public const string REQUEST_HEADER_REFERER = 'referer';

    /**
     * @uses \SprykerShop\Yves\CartPage\Plugin\Router\CartPageRouteProviderPlugin::ROUTE_NAME_CART
     */
    protected const string ROUTE_NAME_CART = 'cart';

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|array
     */
    public function indexAction(Request $request)
    {
        $form = $this->getFactory()
            ->getCartNoteQuoteForm()
            ->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $note = (string)$form->get(QuoteCartNoteForm::FIELD_CART_NOTE)->getData();

            $quoteResponseTransfer = $this->getFactory()
                ->getCartNoteClient()
                ->setNoteToQuote($note);
            $this->handleCartNoteQuoteResponse($quoteResponseTransfer);
        }

        return $this->redirectResponseExternal($this->getRefererUrl($request));
    }

    protected function handleCartNoteQuoteResponse(QuoteResponseTransfer $quoteResponseTransfer): void
    {
        if (!$quoteResponseTransfer->getIsSuccessful()) {
            $this->handleQuoteResponseTransferErrors($quoteResponseTransfer);

            return;
        }

        $this->addSuccessMessage($this->getSuccessMessage());
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return string
     */
    protected function getRefererUrl(Request $request)
    {
        if ($request->headers->has(static::REQUEST_HEADER_REFERER)) {
            return (string)$request->headers->get(static::REQUEST_HEADER_REFERER);
        }

        return static::ROUTE_NAME_CART;
    }

    protected function getSuccessMessage(): string
    {
        return $this->getFactory()->getGlossaryClient()
            ->translate(Messages::MESSAGE_CART_NOTE_ADDED_TO_CART_SUCCESS, $this->getLocale());
    }
}
