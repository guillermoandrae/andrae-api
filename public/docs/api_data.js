define({ "api": [  {    "type": "get",    "url": "/posts/:id",    "title": "Request Post by ID",    "name": "GetPost",    "group": "Posts",    "parameter": {      "fields": {        "Parameter": [          {            "group": "Parameter",            "type": "Number",            "optional": false,            "field": "id",            "description": "<p>Post ID.</p>"          }        ]      }    },    "success": {      "fields": {        "Success 200": [          {            "group": "Success 200",            "type": "Object",            "optional": false,            "field": "Post.",            "description": ""          }        ]      }    },    "version": "0.0.0",    "filename": "/Users/guillermo.fisher/Workspace/andrae/app/Http/Controllers/PostsController.php",    "groupTitle": "Posts"  },  {    "type": "get",    "url": "/posts/?q=:keyword",    "title": "Search for Posts",    "name": "SearchPosts",    "group": "Posts",    "parameter": {      "fields": {        "Parameter": [          {            "group": "Parameter",            "type": "String",            "optional": false,            "field": "keyword",            "description": "<p>Keyword to search for.</p>"          }        ]      }    },    "success": {      "fields": {        "Success 200": [          {            "group": "Success 200",            "type": "Object[]",            "optional": false,            "field": "List",            "description": "<p>of posts.</p>"          }        ]      }    },    "version": "0.0.0",    "filename": "/Users/guillermo.fisher/Workspace/andrae/app/Http/Controllers/PostsController.php",    "groupTitle": "Posts"  }] });
