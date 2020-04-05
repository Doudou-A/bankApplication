<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200405080030 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE transfert ADD account_to_debit_id INT DEFAULT NULL, ADD account_to_credit_id INT DEFAULT NULL, DROP account_to_debit, DROP account_to_credit');
        $this->addSql('ALTER TABLE transfert ADD CONSTRAINT FK_1E4EACBB5850E043 FOREIGN KEY (account_to_debit_id) REFERENCES account (id)');
        $this->addSql('ALTER TABLE transfert ADD CONSTRAINT FK_1E4EACBB667DEECE FOREIGN KEY (account_to_credit_id) REFERENCES account (id)');
        $this->addSql('CREATE INDEX IDX_1E4EACBB5850E043 ON transfert (account_to_debit_id)');
        $this->addSql('CREATE INDEX IDX_1E4EACBB667DEECE ON transfert (account_to_credit_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE transfert DROP FOREIGN KEY FK_1E4EACBB5850E043');
        $this->addSql('ALTER TABLE transfert DROP FOREIGN KEY FK_1E4EACBB667DEECE');
        $this->addSql('DROP INDEX IDX_1E4EACBB5850E043 ON transfert');
        $this->addSql('DROP INDEX IDX_1E4EACBB667DEECE ON transfert');
        $this->addSql('ALTER TABLE transfert ADD account_to_debit INT NOT NULL, ADD account_to_credit INT NOT NULL, DROP account_to_debit_id, DROP account_to_credit_id');
    }
}
