Use config.php.dist to configure the database and rename it to config.php

CREATE CONTACT: 


* index.php?action=create
        * Payload: 

        {
            "data": 
            [ 
                {"firstname":"Luis T", "surname":"Mendoza", 
                    "emails":[{"email":"luis@atomoweb.com"},
                        {"email":"info@atomoweb.com"}], 
                    "phones":[{"phone":"+591.79821755"},
                    {"phone":"+591.12323232"}] },
                {"firstname":"F T", "surname":"Terrazas", 
                    "emails":[{"email":"luis2@atomoweb.com"},
                        {"email":"info2@atomoweb.com"}], 
                        "phones":[{"phone":"+591.78881455"},
                        {"phone":"+591.14324232"}] }
            ]
        }

READ CONTACT:


* index.php?action=read 


UPDATE CONTACT: 


* index.php?action=update
        * Payload:

        {
            "data": [ {"id":19, "firstname":"Luis21", "surname":"Mendoza21", 
                "emails": [{"EmailID":21, "Email": "test1@atomoweb.com"}], 
                "phones":[{"PhoneID":17, "Phone":"1234"}] 
            }]
        }


DELETE CONTACT: 


        * index.php?action=delete&id=CONTACT_ID

