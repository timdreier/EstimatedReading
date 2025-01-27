<?php
namespace TimDreier\TdReadingTime\ViewHelpers;

/**
 * ViewHelper to display informations about given StringGroup
 *
 * # Example: Basic example
 * <code>
 * <p:EstimateReading keyword="myKeyword" variable="chars" />
 * </code>
 * <output>
 * 1234 chars
 * </output>
 *
 *  Warning: This will only output a placeholder which will be replaced with a hook later
 *           Working with a hook is required in order to show times and counts before the content is shown
 *           e.g.: "Reading the following blog article takes 5 minutes." shows 5 minutes before the blog article
 *           is shown.
 */
class EstimateReadingViewHelper extends \TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper
{
    /**
     * Initialize arguments
     */
    public function initializeArguments()
    {
        parent::initializeArguments();
        $this->registerArgument('keyword', 'string', 'Keyword to Manage multiple TdReadingTimes', true, 'default');
        $this->registerArgument('variable', 'string', 'Variable to look up in StringGroup', true, '');
    }

    /**
     * function render
     *
     * @return \string
     */
    public function render()
    {
        if ($this->arguments['variable'] === '') {
            throw new Exception('Attribute "variable" of Tag EstimateReading cannot be empty!');
        }
        return '###tdEstimateReading_' . $this->arguments['keyword'] . '_' . $this->arguments['variable'] . '###';
    }
}
