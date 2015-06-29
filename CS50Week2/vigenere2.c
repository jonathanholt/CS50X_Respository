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
     string input = GetString();
     int x = 0%strlen(s);
     
     // The main algorithm, with the value of x incrementing and cycling through the
     // chosen key.
     if (input != NULL)
         for (int i = 0, sl = strlen(input); i < sl; i++, x++)
         {
         if(input[i] >= 'A' && input[i] <= 'Z')
         {
         if(s[x]>= 'A' && s[x] <= 'Z')
         {
         input[i] = (((input[i]-'A') + (s[x]-'A')) % 26) + 'A';
                printf("%c", input[i]);
         }
         
            else
            {
                input[i] = (((input[i]-'A') + (s[x]-'a')) % 26) + 'A';
                printf("%c", input[i]);                
            }
            }
            else if (input[i] >= 'a' && input[i] <= 'z') //if p[i] is lowercase
        {
            if (s[x] >= 'a' && s[x] <= 'z') // if k[i] is lowercase
            {
                input[i] = (((input[i]-'a') + (s[x]-'a')) % 26) + 'a';
                printf("%c", input[i]);        
            }
            else
            {
                input[i] = (((input[i]-'a') + (s[x]-'A')) % 26) + 'a';
                printf("%c", input[i]);               
            }        
        }    
        else
        {
            printf("%c", input[i]);//if it's a non-alphabet character, just print it
            x--;
        }                         
    }
    
    printf("\n");
            }     
