<?php

namespace Dev4b\LaravelCrudHelper\Forms;

use Illuminate\Contracts\View\View;

class TabsForm
{
    /**
     * @var AbstractForm
     */
    protected $forms = [];

    private string $parentView;

    public function __construct(string $parentView)
    {
        $this->parentView = $parentView;
    }

    public function view(): View
    {
        return view('laravel-crud-helper::tabsForm')
            ->with('forms', $this->forms)
            ->with('parentView', $this->parentView);
    }

    public function render(): string
    {
        return $this->view()->render();
    }

    public function addForm(AbstractForm $form)
    {
        $this->forms[] = $form;
    }
}
