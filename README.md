# Netflix-clone - Video Streaming Site 
_built solely with PHP, HTML, CSS & JavaScript_  

### Using Scalable Technologies including: 
* PHP Data Objects (PDO) PHP 5.1+
* Maria DB (MySQL)
* Vanilla JS & JQuery
* Native PHP

                             * Note: This website will only work if you create an identical database structure *

### Step 1: Create the Database:
     Open PHP My Admin and run an SQL DUMP by uploading the following file (or copying and pasting the file contents): database-STRUCTURE-AND-DATA.sql or database-STRUCTURE-ONLY.sql.
  
### Step 2: Create the 'entities' folder in the root directory where the videos & images will be stored
    (not uploaded on github due to copyright - see .gitignore file)
    
### Step 3: In the entities folder, create three more folders (case-sensitive): 
    1. previews
    2. thumbnails 
    3. videos
    
    the entities folder now should have three folders/directories within it.

_PS. If you run into any code conflits, you likely have a database name conflict. Try to run selective SQL DUMPs in your PHP MY ADMIN by copying and pasting portions of the above .sql files at a time to get a feel for what works and what doesn't. The site works seamlessly for me because my entities folder is full (previews and videos with .mp4 files, thumbnails with .jpg; however, your folders will be empty. You may need to add some .mp4 or .jpg files of your own_

### Step 4: Run The Site on Your Local Server!
