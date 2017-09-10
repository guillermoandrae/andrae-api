<?php

namespace App\Console\Commands;

use App\Services\PostImporterServiceFactory;
use App\Services\PostImporterServiceInterface;
use Illuminate\Console\Command;

class ImportPostsCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'import:posts {source}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import posts from one of the available sources';

    /**
     * @var PostImporterServiceInterface
     */
    protected $importer;

    /**
     * Execute the console command.
     *
     * @return boolean
     */
    public function fire()
    {
        try {
            $this->validate();
            $extractedData = $this->extract();
            $transformedData = $this->transform($extractedData);
            $this->import($transformedData);
        } catch (\Exception $ex) {
            $this->error($ex->getMessage());
            return false;
        }
    }

    /**
     * @return void
     */
    private function validate()
    {
        $source = $this->argument('source');
        $this->info(sprintf('You provided the following source: %s.', $source));
        if (!$importer = PostImporterServiceFactory::factory($source)) {
            throw new \DomainException(sprintf('There is no importer available for %s.', $source));
        }
        $this->importer = $importer;
    }

    /**
     * @return array
     * @throws \ErrorException
     */
    private function extract(): array
    {
        $source = $this->argument('source');
        $this->info(sprintf('Extracting data from %s...', $source));
        if (!$extractedData = $this->importer->extract()) {
            throw new \ErrorException(sprintf('Could not extract %s data', $source));
        }
        $this->info(sprintf('Successfully extracted %d posts from %s.', count($extractedData), $source));
        return $extractedData;
    }

    /**
     * @param array $extractedData
     * @return mixed
     * @throws \ErrorException
     */
    private function transform(array $extractedData): array
    {
        $source = $this->argument('source');
        $this->info(sprintf('Transforming %s data...', $source));
        if (!$transformedData = $this->importer->transform($extractedData)) {
            throw new \ErrorException(sprintf('There is no importer available for %s.', $source));
        }
        $this->info('Successfully transformed data.');
        return $transformedData;
    }

    /**
     * @param array $transformedData
     * @return void
     * @throws \ErrorException
     */
    private function import(array $transformedData)
    {
        $this->info('Loading data:');
        $bar = $this->output->createProgressBar(count($transformedData));
        foreach ($transformedData as $data) {
            if (!$this->importer->import($data)) {
                throw new \ErrorException(sprintf('Could not load data.'));
            }
            $bar->advance();
        }
        $bar->finish();
        $this->info('Successfully loaded data.');
    }
}
