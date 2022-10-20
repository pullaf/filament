<?php

namespace Filament\Forms\Components\Actions;

use Filament\Actions\Concerns\CanBeDisabled;
use Filament\Actions\Concerns\CanOpenUrl;
use Filament\Actions\Concerns\HasTooltip;
use Filament\Actions\MountableAction;
use Filament\Forms\Components\Actions\Modal\Actions\Action as ModalAction;

class Action extends MountableAction
{
    use Concerns\BelongsToComponent;
    use CanBeDisabled;
    use CanOpenUrl;
    use HasTooltip;

    protected string $view = 'filament-forms::components.actions.icon-button-action';

    public function iconButton(): static
    {
        $this->view('filament-forms::components.actions.icon-button-action');

        return $this;
    }

    protected function getLivewireCallActionName(): string
    {
        return 'callMountedFormComponentAction';
    }

    protected static function getModalActionClass(): string
    {
        return ModalAction::class;
    }

    public static function makeModalAction(string $name): ModalAction
    {
        /** @var ModalAction $action */
        $action = parent::makeModalAction($name);

        return $action;
    }

    protected function getDefaultEvaluationParameters(): array
    {
        return array_merge(parent::getDefaultEvaluationParameters(), [
            'component' => $this->getComponent(),
        ]);
    }
}
