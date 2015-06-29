/****************************************************************************
 * dictionary.c
 ***************************************************************************/

#include <stdbool.h>
#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include <ctype.h>

#include "dictionary.h"

#define HT_SIZE 5000 

//Define node struct and initiase wordcount
int wordcount;

typedef struct node
{
    char word[LENGTH+1]; 
    struct node* next;
} 
node;

node* hashtable[HT_SIZE];

//Create our hash function
int hash (const char* word)
{
    int hash = 0;
    int n;
    for (int i = 0; word[i] != '\0'; i++)
    {
        // alphabet case
        if(isalpha(word[i]))
            n = word [i] - 'a' + 1;
        
        // comma case
        else
            n = 27;
            
        hash = ((hash << 3) + n) % HT_SIZE;
    }
    return hash;    
}


/**
 * Loads dictionary into memory.  Returns true if successful else false.
 */
 
bool load(const char* dictionary)
{
    // opens dictionary
    FILE* file = fopen(dictionary, "r");
    if (file == NULL)
    {
        return false;
    }
    
    // create an array for word to be stored in
    char word[LENGTH+1];
    
    int hv; //Hash Value
  
    // Initialize hash table
    for (int i = 0; i<HT_SIZE; i++) 
    {
        hashtable[i] = NULL;
    }
    
    //Add each word to the hashtable individually
    while (fscanf(file,"%s\n",word) != EOF) 
    {
        node* new_node = malloc(sizeof(node));
        strcpy(new_node->word, word);
        hv = hash(word);
        wordcount ++;
        
        //Check if this is the first node in the 'bucket' or not
        if (hashtable[hv] == NULL)
        {
            hashtable[hv] = new_node;
            new_node->next = NULL;
        }    
        else
        {
            new_node->next = hashtable[hv];
            hashtable[hv] = new_node;
        }
    }
    // close file
    fclose(file);
    return true;
}

/**
 * Returns true if word is in dictionary else false.
 */
bool check(const char* word)
{
    char temp_word[LENGTH +1];
    int len = strlen(word);
    
    //Crate a temporary word variable that is lowercase
    for(int i = 0; i < len; i++)
    {
        temp_word[i] = tolower(word[i]);
    }
    temp_word[len] = '\0';
    
    int hv; //Hash Value
    hv = hash(temp_word);
    
    //Check if it's in the hashtable
    if(hashtable[hv] == NULL)
    {
        return false;
    }
    
    node* pointer = hashtable[hv];
    
    while(pointer != NULL) 
    {
        if (strcmp(temp_word, pointer->word) == 0)
        {
            return true;
        }
        pointer = pointer->next;
    }
    
    return false;
}



/**
 * Returns number of words in dictionary if loaded else 0 if not yet loaded.
 */
unsigned int size(void)
{
    if(load)
    {
        return wordcount;
    }
    else
    {
        return 1;
    }
}

/**
 * Unloads dictionary from memory.  Returns true if successful else false.
 */
bool unload(void)
{
    int pointer = 0;
    
    while (pointer < HT_SIZE) 
    {
        // if hashtable is empty go to next bucket
        if (hashtable[pointer] == NULL)
        {
            pointer++;
        }
        
        // if hashtable is not empty, free the nodes
        else
        {
            while (hashtable[pointer] != NULL)
            {
                node* temp = hashtable[pointer];
                hashtable[pointer] = temp->next;
                free(temp);
            }
            
            pointer ++;
        }
    }    
    return true;
}
