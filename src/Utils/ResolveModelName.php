<?php


namespace Sfneal\CrudModelActions\Utils;


use Sfneal\Actions\AbstractAction;
use Sfneal\Helpers\Laravel\LaravelHelpers;
use Sfneal\Models\AbstractModel;

class ResolveModelName extends AbstractAction
{
    /**
     * @var AbstractModel
     */
    private $model;

    /**
     * @var bool
     */
    private $short;

    /**
     * ResolveModelName constructor.
     *
     * @param AbstractModel $model
     * @param bool $short
     */
    public function __construct(AbstractModel $model, bool $short = true)
    {
        $this->model = $model;
        $this->short = $short;
    }

    /**
     * Retrieve the Model class's short name (without namespace).
     *
     * @return mixed
     */
    public function execute()
    {
        // Split string on upper case characters
        return implode(' ', $this->camelCaseSplit($this->getClassName()));
    }

    /**
     * Explode a string using upper case chars as the separator.
     *
     * @param string $string
     * @return array
     */
    private function camelCaseSplit(string $string): array
    {
        return preg_split('/(?=[A-Z])/', $string, -1, PREG_SPLIT_NO_EMPTY);
    }

    /**
     * Retrieve the name from the Model's class name or the table name.
     *
     * @return string
     */
    private function getClassName(): string
    {
        return LaravelHelpers::getClassName($this->model, $this->short, $this->getTableCamelCase());
    }

    /**
     * Convert table name to a CamelCase string for consistency with Model names.
     *
     * @return string
     */
    private function getTableCamelCase(): string
    {
        return implode(
            '',
            array_map(
                function (string $piece) {
                    return ucfirst($piece);
                },
                explode('_', $this->model->getTable())
            )
        );
    }
}
