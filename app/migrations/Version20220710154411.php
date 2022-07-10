<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220710154411 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE blog DROP FOREIGN KEY FK_C01551439D86650F');
        $this->addSql('DROP INDEX IDX_C01551439D86650F ON blog');
        $this->addSql('ALTER TABLE blog CHANGE user_id_id user_id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE blog ADD CONSTRAINT FK_C0155143A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_C0155143A76ED395 ON blog (user_id)');
        $this->addSql('ALTER TABLE data_user DROP FOREIGN KEY FK_36DC1DAB9D86650F');
        $this->addSql('ALTER TABLE data_user DROP FOREIGN KEY FK_36DC1DABE813F933');
        $this->addSql('DROP INDEX IDX_36DC1DAB9D86650F ON data_user');
        $this->addSql('DROP INDEX IDX_36DC1DABE813F933 ON data_user');
        $this->addSql('ALTER TABLE data_user CHANGE user_id_id user_id BINARY(16) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', CHANGE section_id_id section_id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE data_user ADD CONSTRAINT FK_36DC1DABA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE data_user ADD CONSTRAINT FK_36DC1DABD823E37A FOREIGN KEY (section_id) REFERENCES section (id)');
        $this->addSql('CREATE INDEX IDX_36DC1DABA76ED395 ON data_user (user_id)');
        $this->addSql('CREATE INDEX IDX_36DC1DABD823E37A ON data_user (section_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE blog DROP FOREIGN KEY FK_C0155143A76ED395');
        $this->addSql('DROP INDEX IDX_C0155143A76ED395 ON blog');
        $this->addSql('ALTER TABLE blog CHANGE user_id user_id_id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE blog ADD CONSTRAINT FK_C01551439D86650F FOREIGN KEY (user_id_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_C01551439D86650F ON blog (user_id_id)');
        $this->addSql('ALTER TABLE data_user DROP FOREIGN KEY FK_36DC1DABA76ED395');
        $this->addSql('ALTER TABLE data_user DROP FOREIGN KEY FK_36DC1DABD823E37A');
        $this->addSql('DROP INDEX IDX_36DC1DABA76ED395 ON data_user');
        $this->addSql('DROP INDEX IDX_36DC1DABD823E37A ON data_user');
        $this->addSql('ALTER TABLE data_user CHANGE user_id user_id_id BINARY(16) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', CHANGE section_id section_id_id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE data_user ADD CONSTRAINT FK_36DC1DAB9D86650F FOREIGN KEY (user_id_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE data_user ADD CONSTRAINT FK_36DC1DABE813F933 FOREIGN KEY (section_id_id) REFERENCES section (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_36DC1DAB9D86650F ON data_user (user_id_id)');
        $this->addSql('CREATE INDEX IDX_36DC1DABE813F933 ON data_user (section_id_id)');
    }
}
