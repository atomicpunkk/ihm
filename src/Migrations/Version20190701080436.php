<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190701080436 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE machine (id INT AUTO_INCREMENT NOT NULL, author_id INT NOT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_1505DF84F675F31B (author_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE output (id INT AUTO_INCREMENT NOT NULL, machine_id INT NOT NULL, material_id INT NOT NULL, number VARCHAR(255) NOT NULL, output_time VARCHAR(255) NOT NULL, INDEX IDX_CCDE149EF6B75B26 (machine_id), INDEX IDX_CCDE149EE308AC6F (material_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE material (id INT AUTO_INCREMENT NOT NULL, author_id INT NOT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_7CBE7595F675F31B (author_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE input (id INT AUTO_INCREMENT NOT NULL, machine_id INT NOT NULL, material_id INT NOT NULL, number VARCHAR(255) NOT NULL, INDEX IDX_D82832D7F6B75B26 (machine_id), INDEX IDX_D82832D7E308AC6F (material_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE machine ADD CONSTRAINT FK_1505DF84F675F31B FOREIGN KEY (author_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE output ADD CONSTRAINT FK_CCDE149EF6B75B26 FOREIGN KEY (machine_id) REFERENCES machine (id)');
        $this->addSql('ALTER TABLE output ADD CONSTRAINT FK_CCDE149EE308AC6F FOREIGN KEY (material_id) REFERENCES material (id)');
        $this->addSql('ALTER TABLE material ADD CONSTRAINT FK_7CBE7595F675F31B FOREIGN KEY (author_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE input ADD CONSTRAINT FK_D82832D7F6B75B26 FOREIGN KEY (machine_id) REFERENCES machine (id)');
        $this->addSql('ALTER TABLE input ADD CONSTRAINT FK_D82832D7E308AC6F FOREIGN KEY (material_id) REFERENCES material (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE output DROP FOREIGN KEY FK_CCDE149EF6B75B26');
        $this->addSql('ALTER TABLE input DROP FOREIGN KEY FK_D82832D7F6B75B26');
        $this->addSql('ALTER TABLE machine DROP FOREIGN KEY FK_1505DF84F675F31B');
        $this->addSql('ALTER TABLE material DROP FOREIGN KEY FK_7CBE7595F675F31B');
        $this->addSql('ALTER TABLE output DROP FOREIGN KEY FK_CCDE149EE308AC6F');
        $this->addSql('ALTER TABLE input DROP FOREIGN KEY FK_D82832D7E308AC6F');
        $this->addSql('DROP TABLE machine');
        $this->addSql('DROP TABLE output');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE material');
        $this->addSql('DROP TABLE input');
    }
}
