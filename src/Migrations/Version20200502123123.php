<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200502123123 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE comments DROP FOREIGN KEY FK_5F9E962A20E394C2');
        $this->addSql('DROP INDEX IDX_5F9E962A20E394C2 ON comments');
        $this->addSql('ALTER TABLE comments ADD users_id INT NOT NULL, DROP pseudo_id, DROP user_id');
        $this->addSql('ALTER TABLE comments ADD CONSTRAINT FK_5F9E962A67B3B43D FOREIGN KEY (users_id) REFERENCES users (id)');
        $this->addSql('CREATE INDEX IDX_5F9E962A67B3B43D ON comments (users_id)');
        $this->addSql('ALTER TABLE users ADD username VARCHAR(255) NOT NULL, ADD roles VARCHAR(255) NOT NULL, DROP pseudo, DROP role');
        $this->addSql('ALTER TABLE cvinfos ADD updated_at DATETIME NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE comments DROP FOREIGN KEY FK_5F9E962A67B3B43D');
        $this->addSql('DROP INDEX IDX_5F9E962A67B3B43D ON comments');
        $this->addSql('ALTER TABLE comments ADD pseudo_id INT DEFAULT NULL, ADD user_id INT DEFAULT NULL, DROP users_id');
        $this->addSql('ALTER TABLE comments ADD CONSTRAINT FK_5F9E962A20E394C2 FOREIGN KEY (pseudo_id) REFERENCES users (id)');
        $this->addSql('CREATE INDEX IDX_5F9E962A20E394C2 ON comments (pseudo_id)');
        $this->addSql('ALTER TABLE cvinfos DROP updated_at');
        $this->addSql('ALTER TABLE users ADD pseudo VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, ADD role VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, DROP username, DROP roles');
    }
}
