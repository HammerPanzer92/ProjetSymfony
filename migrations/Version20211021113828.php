<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211021113828 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE jeu (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, date_sortie DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE test (id INT AUTO_INCREMENT NOT NULL, id_testeur_id INT NOT NULL, id_jeu_id INT NOT NULL, note SMALLINT NOT NULL, contenu LONGTEXT NOT NULL, INDEX IDX_D87F7E0CA493EE80 (id_testeur_id), UNIQUE INDEX UNIQ_D87F7E0CAAA98CC3 (id_jeu_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE test ADD CONSTRAINT FK_D87F7E0CA493EE80 FOREIGN KEY (id_testeur_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE test ADD CONSTRAINT FK_D87F7E0CAAA98CC3 FOREIGN KEY (id_jeu_id) REFERENCES jeu (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE test DROP FOREIGN KEY FK_D87F7E0CAAA98CC3');
        $this->addSql('ALTER TABLE test DROP FOREIGN KEY FK_D87F7E0CA493EE80');
        $this->addSql('DROP TABLE jeu');
        $this->addSql('DROP TABLE test');
        $this->addSql('DROP TABLE `user`');
    }
}
