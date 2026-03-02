<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerShop\Yves\CartNoteWidget\Dependency\Client;

use Generated\Shared\Transfer\QuoteResponseTransfer;

interface CartNoteWidgetToCartNoteClientInterface
{
    public function setNoteToQuoteItem(string $note, string $sku, ?string $groupKey = null): QuoteResponseTransfer;

    public function setNoteToQuote(string $note): QuoteResponseTransfer;
}
