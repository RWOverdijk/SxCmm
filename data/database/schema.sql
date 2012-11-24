CREATE TABLE component (id INT AUTO_INCREMENT NOT NULL, page_id VARCHAR(200) NOT NULL, position INT NOT NULL, area VARCHAR(200) NOT NULL, type VARCHAR(200) NOT NULL, INDEX page_id_idx (page_id), INDEX area_idx (area), INDEX type_idx (type), INDEX search_idx (page_id, area), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;
CREATE TABLE component_setting (id INT AUTO_INCREMENT NOT NULL, component_id INT DEFAULT NULL, setting_key VARCHAR(200) NOT NULL, locale VARCHAR(30) DEFAULT NULL, setting_value LONGTEXT NOT NULL, INDEX IDX_2F7839B1E2ABAFFF (component_id), INDEX setting_key_idx (setting_key), INDEX locale_idx (locale), UNIQUE INDEX setting_unique (component_id, setting_key, locale), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;
ALTER TABLE component_setting ADD CONSTRAINT FK_2F7839B1E2ABAFFF FOREIGN KEY (component_id) REFERENCES component (id);

-- Optional data
insert into component set page_id = 1, area='main', type='text', position=1;
insert into component set page_id = 1, area='main', type='text', position=2;
insert into component_setting set component_id=1, setting_key='text', setting_value='zis is german!', locale='de-DE';
insert into component_setting set component_id=1, setting_key='text', setting_value='Hello world! Here, have some bacon!';
insert into component_setting set component_id=2, setting_key='text', setting_value='Bacon is really really good for you, really!';
