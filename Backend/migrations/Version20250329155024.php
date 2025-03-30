<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250329155024 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE inscription DROP FOREIGN KEY inscription_ibfk_2
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE inscription DROP FOREIGN KEY inscription_ibfk_1
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX id_user ON inscription
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX id_event ON inscription
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE inscription ADD user_id INT NOT NULL, ADD event_id INT NOT NULL, DROP id_user, DROP id_event
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE inscription ADD CONSTRAINT FK_5E90F6D6A76ED395 FOREIGN KEY (user_id) REFERENCES users (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE inscription ADD CONSTRAINT FK_5E90F6D671F7E88B FOREIGN KEY (event_id) REFERENCES events (id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_5E90F6D6A76ED395 ON inscription (user_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_5E90F6D671F7E88B ON inscription (event_id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE inscription DROP FOREIGN KEY FK_5E90F6D6A76ED395
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE inscription DROP FOREIGN KEY FK_5E90F6D671F7E88B
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_5E90F6D6A76ED395 ON inscription
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_5E90F6D671F7E88B ON inscription
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE inscription ADD id_user INT NOT NULL, ADD id_event INT NOT NULL, DROP user_id, DROP event_id
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE inscription ADD CONSTRAINT inscription_ibfk_2 FOREIGN KEY (id_event) REFERENCES events (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE inscription ADD CONSTRAINT inscription_ibfk_1 FOREIGN KEY (id_user) REFERENCES users (id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX id_user ON inscription (id_user)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX id_event ON inscription (id_event)
        SQL);
    }
}
