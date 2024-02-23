<?php

namespace TallComponents\Livewire\Traits;

use Exception;
use Livewire\Attributes\On;

trait WithTcConfirmation
{
    public bool $showTcConfirmationModal = false;

    /** @property array<string, string> */
    public array $tcConfirmationModalData = [
        'title' => '',
        'message' => '',
        'action' => '',
    ];

    #[On('tc-confirmation')]
    public function tcConfirmation(string $data)
    {
        $prepareString = str_replace(['\n', "'", 'title:', 'message:', 'action:'], ['', '"', '"title":', '"message":', '"action":'], $data);

        $data = json_decode($prepareString, true);

        if (! isset($data['message']) || ! isset($data['action'])) {
            throw new Exception('Incorrect parameters for confirmation modal.');
        }

        $this->fill([
            'showTcConfirmationModal' => true,
            'tcConfirmationModalData' => $data,
        ]);
    }
}
