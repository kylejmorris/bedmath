USER: Object
GETTER METHODS:
- getUserId(); //Grabs the users id based on their username
- getUsername(); //Grabs the users username based on their id

SETTER METHODS:

CONDITIONAL METHODS:
- userExists(); //Check if user is already registered in database

POINTS: Object
- setPoints(); //Erase current user points and replace with value specified
- addPoints(); //Add's points to user, takes value of username and points amount
- removePoints(); //removes points from user, takes value of username and points to remove


SESSION: object
- init(); //Start_session() method is called and some other pre-config stuff. 
- destroy(); //Destroys session
- create();/
- edit(); //Edit session data
