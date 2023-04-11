<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230410220114 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE camping CHANGE description description LONGTEXT NOT NULL');
        $this->addSql('ALTER TABLE participation CHANGE id_Parti id_parti INT AUTO_INCREMENT NOT NULL, CHANGE id_Client id_client INT NOT NULL, CHANGE id_Camp id_camp INT NOT NULL, CHANGE id_Rand id_rand INT NOT NULL, CHANGE id_events id_events INT NOT NULL, CHANGE date_Parti date_parti DATETIME NOT NULL, ADD PRIMARY KEY (id_parti)');
        $this->addSql('ALTER TABLE randonnee CHANGE id_Randonnee id_randonnee INT AUTO_INCREMENT NOT NULL, CHANGE Date_Rand date_rand DATETIME NOT NULL, ADD PRIMARY KEY (id_randonnee)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE camping CHANGE description description VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE participation MODIFY id_parti INT NOT NULL');
        $this->addSql('DROP INDEX `primary` ON participation');
        $this->addSql('ALTER TABLE participation CHANGE id_parti id_Parti INT NOT NULL, CHANGE id_client id_Client INT DEFAULT NULL, CHANGE id_camp id_Camp INT DEFAULT NULL, CHANGE id_rand id_Rand INT DEFAULT NULL, CHANGE id_events id_events INT DEFAULT NULL, CHANGE date_parti date_Parti DATE NOT NULL');
        $this->addSql('ALTER TABLE randonnee MODIFY id_randonnee INT NOT NULL');
        $this->addSql('DROP INDEX `primary` ON randonnee');
        $this->addSql('ALTER TABLE randonnee CHANGE id_randonnee id_Randonnee INT NOT NULL, CHANGE date_rand Date_Rand DATE NOT NULL');
    }
}
