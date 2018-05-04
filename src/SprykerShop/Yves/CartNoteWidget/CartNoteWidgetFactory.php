<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerShop\Yves\CartNoteWidget;

use Spryker\Shared\Application\ApplicationConstants;
use Spryker\Yves\Kernel\AbstractFactory;
use SprykerShop\Yves\CartNoteWidget\Dependency\Client\CartNoteWidgetToCartNoteClientInterface;
use SprykerShop\Yves\CartNoteWidget\Dependency\Client\CartNoteWidgetToGlossaryStorageClientInterface;
use SprykerShop\Yves\CartNoteWidget\Form\QuoteCartNoteForm;
use SprykerShop\Yves\CartNoteWidget\Form\QuoteItemCartNoteForm;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\FormInterface;

class CartNoteWidgetFactory extends AbstractFactory
{
    /**
     * @return \Symfony\Component\Form\FormInterface
     */
    public function getCartNoteQuoteForm(): FormInterface
    {
        return $this->getFormFactory()->create(QuoteCartNoteForm::class);
    }

    /**
     * @return \Symfony\Component\Form\FormInterface
     */
    public function getCartNoteQuoteItemForm(): FormInterface
    {
        return $this->getFormFactory()->create(QuoteItemCartNoteForm::class);
    }

    /**
     * @return \SprykerShop\Yves\CartNoteWidget\Dependency\Client\CartNoteWidgetToCartNoteClientInterface
     */
    public function getCartNoteClient(): CartNoteWidgetToCartNoteClientInterface
    {
        return $this->getProvidedDependency(CartNoteWidgetDependencyProvider::CLIENT_CART_NOTE);
    }

    /**
     * @return \Symfony\Component\Form\FormFactoryInterface
     */
    public function getFormFactory(): FormFactoryInterface
    {
        return $this->getProvidedDependency(ApplicationConstants::FORM_FACTORY);
    }

    /**
     * @return \SprykerShop\Yves\CartNoteWidget\Dependency\Client\CartNoteWidgetToGlossaryStorageClientInterface
     */
    public function getGlossaryClient(): CartNoteWidgetToGlossaryStorageClientInterface
    {
        return $this->getProvidedDependency(CartNoteWidgetDependencyProvider::CLIENT_GLOSSARY);
    }
}
