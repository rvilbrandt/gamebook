# Gamebook Parser
PHP Parser for gamebook files by Ronald Vilbrandt

# About
This small but decent project is for fulfilling the dream I had since I was a young teenager and read Steve Jackson's 
or Ian Livingstone's fantasy gamebooks. Later I also read so called "solo adventures" of the "Das Schwarze Auge" (The 
Dark Eye / Realms of Arkania) branch which used simply the same technique as the earlier gamebooks already mentioned. 
In the 90s when I was playing around with C64's BASIC, I created some simple text adventures with multiple choice 
options. They weren't really good and long but hey - it was a thing. :smile: Now in 2016, about 20 years later I 
wanted to fulfill my childish dreams and used my skills and some days to create a working version of a parser for 
a self-created gamebook format.

## Sample of a classic gamebook 

Gamebooks have numbered textblocks (which I call "scenes"). You start with the first block to read and at the end you 
have multiple options where to continue your reading. There are two ways to finish the book. The first one is to 
find the right path to the happy ending and the other one is to find one of the many blind alleys with a bad ending 
(in most cases you die a painful death :smile:).

> Welcome to this great adventure. You're standing in front of three doors. Two are already opened, the last one is 
> locked and needs a key to be opened.
> 
> What do you want to do?
> 
> Walk through the first open door. Continue reading at XXX
>
> Go straight through door number two. Continue reading at XXX

While reading through the scenes you usually find some items to take with you or you have to fight against monsters 
by rolling a die. Some options in scenes can only be accessed if you've taken an item with you or made a decision 
previously (e.g. if you've talked to a person or not).

More details at https://en.wikipedia.org/wiki/Gamebook

# What is Gamebook Parser?

My gamebook parser reads a gamebook text file with scenes, options and conditions and parses them to a PHP object. You 
can use it to create HTML pages or a CLI application and let the reader play the game.

# Features of my gamebook format

* Scene with multiple options to go on
* Scene with multiple textblocks that optionally can be shown only when conditions are fulfilled (see conditions)
* Options that optionally can be shown only when conditions are fulfilled (see conditions)
* Conditions can be "states" that are equal, lower, higher or not existing. Also the inventory can be checked if item is or is not in it

# Features of my gamebook parser

* Parsing the current scene, comparing the conditions, handling the inventory and state changes and returning the parsed objects for easy access
* Acts as a model for MVC environments like a charme
* Using simple JSON objects to create PHP objects for easy and object-oriented access (ships with JSON file reader)
* Handling a game state with session writers (ships with PHP Session support)
* Components like JSON file reader or session handler may be replaced by customs instantly

# Future goals

* Character handling with attributes (strength, lifepoints, skills, etc.)
* Monsters/Enemies with attributes
* Fighting based on attributes and virtual "dice rolls"

# Demo

A tiny demo is already included an prints out the parsed scene and inventory as HTML. Try this demo here (based on the 
example gamebook below).


# Structure of my gamebook format

## JSON samples

### Main
```json
{
    "title": "Yet another fairytale",
    "author": "Ronald Vilbrandt",
    "version": "0.4",
    "startScene": "beginning",
    "scenes": [],
    "items": []
}
```

### Simple Scene with dead end
```json
{
    "id": "door_1_death",
    "contents": [
        {
            "text": "You fall into a deep hole to death. Boy, that escalated quickly."
        }
    ]
}
```

### Simple Scene with options to go on
```json
{
    "id": "door_2",
    "contents": [
        {
            "text": "You're standing in an empty room with nothing but a key in the center of the room."
        }
    ],
    "options": [
        {
            "text": "Take the key.",
            "jumpTo": "door_2_key_taken"
        },
        {
            "text": "Leave the key alone and return to the previous room.",
            "jumpTo": "beginning"
        }
    ]

}
```

### Advanced Scene with adding something to the inventory
```json
{
    "id": "door_2_key_taken",
    "contents": [
        {
            "text": "You've put the key into your pocket."
        }
    ],
    "options": [
        {
            "text": "Leave the room.",
            "jumpTo": "beginning"
        }
    ],
    "inventory": {
        "add": [
            "key"
        ]
    }
}
```

### Advanced Scene with setting a state
```json
{
    "id": "door_3",
    "contents": [
        {
            "text": "Congratulation! You've found the final room and exit.\nThank you, stranger! But our Princess is in another castle!"
        }
    ],
    "inventory": {
        "remove": [
            "key"
        ]
    },
    "states": {
        "door_3_opened": 1
    }

}
```

### Complex scene with querying states and inventory for showing options or not
```json
{
    "id": "beginning",
    "contents": [
        {
            "text": "Welcome to this great adventure. You're standing in front of three doors. Two are already opened, the last one is locked and needs a key to be opened."
        }
    ],
    "options": [
        {
            "text": "Walk through the first open door.",
            "jumpTo": "door_1_death"
        }, 
        {
            "text": "Go straight through door number two.",
            "jumpTo": "door_2",
            "conditions": {
                "inventory": {
                    "hasNot": [
                        "key"
                    ]
                }
            }
        }, 
        {
            "text": "Open the locked door with the key.",
            "jumpTo": "door_3",
            "conditions": {
                "inventory": {
                    "has": [
                        "key"
                    ]
                }
            }
        },
        {
            "text": "Go through the door you've openend with the key previously.",
            "jumpTo": "door_3",
            "conditions": {
                "states": {
                    "eq": {
                        "door_3_opened": 1
                    }
                }
            }
        }
    ]
}
```

### Item list
```json
{
    "id": "potion",
    "name": "Magic Potion",
    "description": "One more magic potion. It will heal my aching wounds."
}
```