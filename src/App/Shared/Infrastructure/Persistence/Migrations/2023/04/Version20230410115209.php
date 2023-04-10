<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Persistence\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230410115209 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE blog_article ALTER author_id TYPE VARCHAR(36)');
        $this->addSql('ALTER TABLE blog_article ALTER author_id TYPE VARCHAR(36)');
        $this->addSql('COMMENT ON COLUMN blog_article.author_id IS \'(DC2Type:author_id)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE blog_article ALTER author_id TYPE VARCHAR(36)');
        $this->addSql('ALTER TABLE blog_article ALTER author_id TYPE VARCHAR(36)');
        $this->addSql('COMMENT ON COLUMN blog_article.author_id IS \'(DC2Type:uuid)\'');
    }
}
