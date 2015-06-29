#include <stdio.h>
#include <cs50.h>
#include <string.h>
#include <ctype.h>


int main (int argc, string argv[])
{
    if (argc != 2) // Checks the command line input arguements
    {
        printf("Error. Please enter a keyword.\n");
        return 1;
    }
    
    string s = argv[1];
    
     // Check the command line input to ensure the user inputted a string   
    for (int i = 0, sl = strlen(s); i < sl; i++)  
        {
            if(!(isalpha(s[i]))) 
            {
             printf("You must enter a single key as a command line argument.\n");
             return 1;
             } }  
    
    string input = GetString(); // The user input, the string to be encrypted

    int i, x, sl; 
    // The loop that changes the string according to the Vigenere encryption algorithm
    for (i = 0, x = 0, sl = strlen(input); i < sl; i++, x=((x+1)%strlen(s))) 
    {  
        
        if (input[i] >= 'A' && input[i] <= 'Z') // First we deal with any uppercase input
        {        
            if (s[x] >= 'A' && s[x] <= 'Z') // And modify if any of the key is uppercase
            {
                int c = ((((input[i] - 'A') + (s[x] - 'A')) %26) + 'A'); 
                printf("%c", c);               
            }
            else
            {
                int c = ((((input[i] - 'A') + (s[x] - 'a')) %26) + 'A'); 
                printf("%c", c);                
            }    
        }        
        else if (input[i] >= 'a' && input[i] <= 'z') // Next we check is any input is lowercase
        {
            if (s[x] >= 'a' && s[x] <= 'z') // And check is any of the key is lowercase
            {
                int c = ((((input[i] - 'a') + (s[x] - 'a')) %26) + 'a'); 
                printf("%c", c);        
            }
            else
            {
                int c = ((((input[i] - 'a') + (s[x] - 'A')) %26) + 'a'); 
                printf("%c", c);                
            }        
        }    
        else
        {
            printf("%c", input[i]);// Print non-alphabetical chars
            x--;
        }                         
    }
    
    printf("\n");
}
