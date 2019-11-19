<?php
declare(strict_types=1);

namespace App\Console\Commands;

use Domain\Wishlist\Repository\WishlistRepository;
use Illuminate\Console\Command;
use League\Csv\Writer;

/**
 * Class ExportWishlists.
 */
class ExportWishlists extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'export:wishlists';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Export all wishlists to CSV file';

    /** @var \League\Csv\AbstractCsv */
    private $writer;
    private $filePath;

    private function initializeCsvWriter(): void
    {
        $this->filePath = storage_path('app/'.date('YmdHis').'_export_wishlists.csv');
        $this->writer = Writer::createFromPath($this->filePath, 'w+');
        $this->writer->setDelimiter(';');

        $this->writer->insertOne(['User','Wishlist Name','Products Count']);
    }

    private function addItemsToCsv(array $items): void
    {
        foreach ($items as $item) {
            $this->writer->insertOne([
                $item->user->full_name,
                $item->name,
                $item->products_count
            ]);
        }
    }

    /**
     * Execute the console command.
     *
     * @throws \Exception
     */
    public function handle(WishlistRepository $wishlistRepository): int
    {
        $this->initializeCsvWriter();

        $page = 1;
        do {
            $results = $wishlistRepository->paginateForExport($page);
            $this->addItemsToCsv($results->items());
            $page++;
        } while ($results->hasMorePages());

        $this->info('File written: '.$this->filePath);
        return 1;
    }
}
