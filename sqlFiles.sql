#LOAD DATA LOW_PRIORITY LOCAL INFILE 'D:\\UKM\\Internship Folder\\FinalizedData.csv' IGNORE INTO TABLE 'ivi_masterdata_covid19'.'masterdata' CHARACTER SET utf8 FIELDS TERMINATED BY ';' OPTIONALLY ENCLOSED BY '"' ESCAPED BY '"' LINES TERMINATED BY '\r\n' IGNORE 1 LINES);


#LOAD DATA INFILE 'D:\\UKM\\Internship Folder\\FinalizedData.csv' 
#INTO TABLE ivi_masterdata_covid19.masterdata 
#FIELDS TERMINATED BY ',' 
#ENCLOSED BY '"'
#LINES TERMINATED BY '\n'
#IGNORE 1 ROWS

#SELECT * FROM masterdata;

#DoneSQL - Count all country based on the data
#SELECT DISTINCT nom ,country FROM masterdata;

#SELECT * FROM masterdata WHERE Cost_Increaments LIKE "No,No";

#DELETE FROM ivi_financial_tbl;

#SELECT * FROM ivi_financial_tbl;
INSERT INTO ivi_financial_tbl (Nom, Income_Group, Cost_Increaments)
SELECT Nom, Income_Group, Cost_Increaments FROM ivi_masterdata_covid19.masterdata;

#SELECT  DISTINCT Nom ,Income_Group, Cost_Increaments FROM masterdata WHERE Income_Group LIKE "%Medium income%" AND Cost_Increaments LIKE "%No%";

#DoneSQL - Count all Gender based on the data
#SELECT count(Gender), Gender FROM masterdata GROUP BY Gender ORDER BY Gender;

#DoneSQL - Count all Age_Group based on the data
#SELECT count(Age_Group), Age_Group FROM masterdata GROUP BY Age_Group;

#DoneSQL - Count all Occupation based on the data
#SELECT count(Occupation), Occupation FROM masterdata GROUP BY Occupation;

#DoneSQL - Count all Income_Group based on the data
#SELECT count(Income_Group), Income_Group FROM masterdata GROUP BY Income_Group;

#DoneSQL - Count all Social_Media based on the data
#SELECT count(Social_Media), Social_Media FROM masterdata GROUP BY Social_Media;

#DoneSQL - Count all Usage_Purpose based on the data
#SELECT count(Usage_Purpose), Usage_Purpose FROM masterdata GROUP BY Usage_Purpose;

#DoneSQL - Count all Problems_Occur based on the data
#SELECT count(Problems_Occur), Problems_Occur FROM masterdata GROUP BY Problems_Occur;

#DoneSQL - Count all Cost_Increaments based on the data
#SELECT count(Cost_Increaments), Cost_Increaments FROM masterdata GROUP BY Cost_Increaments;

#DoneSQL - Count all Psychological_Problem based on the data
#SELECT count(Psychological_Problem), Psychological_Problem FROM masterdata GROUP BY Psychological_Problem;

#DoneSQL - Count all Abused based on the data
#SELECT count(Abused), Abused FROM masterdata GROUP BY Abused;

#DoneSQL - Count all Spread_Fake_News based on the data
#SELECT count(Spread_Fake_News), Spread_Fake_News FROM masterdata GROUP BY Spread_Fake_News;

#DoneSQL - Count all Believe_Fake_News based on the data
#SELECT count(Believe_Fake_News), Believe_Fake_News FROM masterdata GROUP BY Believe_Fake_News;

#DoneSQL - Count all Relationship_Rate based on the data
#SELECT count(Relationship_Rate), Relationship_Rate FROM masterdata GROUP BY Relationship_Rate;


