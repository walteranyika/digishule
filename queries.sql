SELECT SUM(score) as total, std_regno, exam_name,term FROM exams GROUP BY exam_name, std_regno, term 
ORDER BY total DESC

---------------------------------
top 10
SELECT students.names, students.stdreg_no,students.class, exams.exam_name, exams.term,
 SUM(exams.score) as total FROM exams JOIN students ON exams.std_regno=students.stdreg_no 
 WHERE students.school_id='ABC126' and students.class LIKE '1%'  GROUP BY exams.exam_name, 
 exams.std_regno, exams.term   ORDER BY total DESC LIMIT 10

 ----------------------------------------------------
 last 10
 SELECT students.names, students.stdreg_no,students.class, exams.exam_name, exams.term,
 SUM(exams.score) as total FROM exams JOIN students ON exams.std_regno=students.stdreg_no 
 WHERE students.school_id='ABC126' and students.class LIKE '1%'  GROUP BY exams.exam_name, 
 exams.std_regno, exams.term   ORDER BY total  LIMIT 10
 -----------------------------------------------------
 all
  SELECT students.names, students.stdreg_no,students.class, exams.exam_name, exams.term,
 SUM(exams.score) as total FROM exams JOIN students ON exams.std_regno=students.stdreg_no 
 WHERE students.school_id='ABC126' and students.class LIKE '1%'  GROUP BY exams.exam_name, 
 exams.std_regno, exams.term   ORDER BY total  
 -----------------------------------------------------
 total per class
 SELECT class, COUNT(names) FROM students WHERE school_id='ABC126' GROUP by class 

 --------------------------------------------------
 total for school
 SELECT  COUNT(names) as total FROM students WHERE school_id='ABC126' 

 ---------------------------------------------------
 total for all schools
 SELECT school_id, COUNT(names) as total FROM students GROUP BY school_id
 -------------------------------------------------------
 