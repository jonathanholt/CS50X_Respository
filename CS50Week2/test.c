#include <stdio.h>
#include <cs50.h>
#include <string.h>
#include <ctype.h>

int main(int argc, string argv[] )
{
string s = argv[1];
   // Check the user command line input
   if(argc!= 2)
       {
             printf("You must enter a single key as a command line argument.\n");
             return 1;
       } 
    // Check the command line input to ensure the user inputted a string   
    for (int i = 0, sl = strlen(s); i < sl; i++)  
        {
            if(!(isalpha(s[i]))) 
            {
             printf("You must enter a single key as a command line argument.\n");
             return 1;
             } }    
     
     // Take the next user input
     string input = GetString(); //string from user to encrypt

    int i, x, sl; //declares variables for loop below
    for (i = 0, j = 0, sl = strlen(p); i < sl; i++, x++) //loop that iterates through user string we're encrypting
    {
        if (x > (strlen(input)) - 1)
        {    
            x = 0; //resets k[j] if user string is longer than keyword, and enables the keyword to be recycled
        }    
        
        if (s[i] >= 'A' && s[i] <= 'Z') //if p[i] is uppercase
        {        
            if (k[x] >= 'A' && k[x] <= 'Z') //if k[i] is uppercase
            {
                int c = ((((s[i] - 'A') + (k[x] - 'A')) %26) + 'A'); 
                printf("%c", c);               
            }
            else
            {
                int c = ((((p[i] - 'A') + (k[x] - 'a')) %26) + 'A'); 
                printf("%c", c);                
            }    
        }        
        else if (p[i] >= 'a' && p[i] <= 'z') //if p[i] is lowercase
        {
            if (k[x] >= 'a' && k[x] <= 'z') // if k[i] is lowercase
            {
                int c = ((((p[i] - 'a') + (k[x] - 'a')) %26) + 'a'); 
                printf("%c", c);        
            }
            else
            {
                int c = ((((p[i] - 'a') + (k[x] - 'A')) %26) + 'a'); 
                printf("%c", c);                
            }        
        }    
        else
        {
            printf("%c", p[i]);//if it's a non-alphabet character, just print it
            j--;
        }                         
    }
    
    printf("\n");
    return 0;
}
