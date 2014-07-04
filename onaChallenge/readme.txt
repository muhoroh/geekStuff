Files organization
  - classes - Contains the classes involved .These are
      1. CoreFunctions
      2. DataCalculator
      
  - Web  - Contains a working web interface for testing the module . Its not very friendly and only geeks 
           are allowed to use it if it is to make some sense.
         - Just put it under a web root eg http://server/onaChallenge/web
         NB: it utilizes the classes which are one directory up and thus the folder classes must exist,else change the include paths
         
   - index.php - This is the bridge between the module and the end consumer . It expects a post/get with a json encoded parameter called url .
   
   - The result is in JSON;      
