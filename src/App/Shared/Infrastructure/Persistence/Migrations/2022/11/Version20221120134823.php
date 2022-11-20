<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Persistence\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221120134823 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE blog_article_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE blog_comment_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE blog_article (id INT NOT NULL, name VARCHAR(255) NOT NULL, content TEXT NOT NULL, author_id VARCHAR(36) NOT NULL, uuid VARCHAR(36) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, status_type VARCHAR(255) NOT NULL, status_update_date TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN blog_article.name IS \'(DC2Type:article_name)\'');
        $this->addSql('COMMENT ON COLUMN blog_article.content IS \'(DC2Type:article_content)\'');
        $this->addSql('COMMENT ON COLUMN blog_article.author_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN blog_article.uuid IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN blog_article.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN blog_article.updated_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN blog_article.status_update_date IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE blog_comment (id INT NOT NULL, article_id INT DEFAULT NULL, content TEXT NOT NULL, commentator_id VARCHAR(36) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_7882EFEF7294869C ON blog_comment (article_id)');
        $this->addSql('COMMENT ON COLUMN blog_comment.content IS \'(DC2Type:comment_content)\'');
        $this->addSql('COMMENT ON COLUMN blog_comment.commentator_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN blog_comment.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN blog_comment.updated_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE blog_comment ADD CONSTRAINT FK_7882EFEF7294869C FOREIGN KEY (article_id) REFERENCES blog_article (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP SEQUENCE blog_article_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE blog_comment_id_seq CASCADE');
        $this->addSql('ALTER TABLE blog_comment DROP CONSTRAINT FK_7882EFEF7294869C');
        $this->addSql('DROP TABLE blog_article');
        $this->addSql('DROP TABLE blog_comment');
    }
}
