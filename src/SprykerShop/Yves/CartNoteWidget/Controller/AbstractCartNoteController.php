<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerShop\Yves\CartNoteWidget\Controller;

use Generated\Shared\Transfer\QuoteErrorTransfer;
use Generated\Shared\Transfer\QuoteResponseTransfer;
use Spryker\Yves\Kernel\Controller\AbstractController;

/**
 * @method \SprykerShop\Yves\CartNoteWidget\CartNoteWidgetFactory getFactory()
 */
abstract class AbstractCartNoteController extends AbstractController
{
    protected function handleQuoteResponseTransferErrors(QuoteResponseTransfer $quoteResponseTransfer): void
    {
        foreach ($quoteResponseTransfer->getErrors() as $quoteErrorTransfer) {
            $this->addErrorMessage($this->translateQuoteError($quoteErrorTransfer));
        }
    }

    protected function translateQuoteError(QuoteErrorTransfer $quoteErrorTransfer): string
    {
        return $this->getFactory()
            ->getGlossaryClient()
            ->translate(
                (string)$quoteErrorTransfer->getMessage(),
                $this->getLocale(),
                $quoteErrorTransfer->getParameters(),
            );
    }
}
