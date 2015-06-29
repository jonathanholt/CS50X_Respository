#include <stdio.h>
#include <cs50.h>
#include <string.h>

int main(int argc, string argv[] )
{
   if(argc != 2 || atoi(argv[1]) < 1)
       {
             // Inform the user and return
             printf("You need to enter 1 integer as an argument:  ./caesar [int].\n");
             return 1;
       }
    int k = atoi(argv[1]);
    
    string input = GetString();
    
    
    if (input != NULL)
        for (int i = 0, sl = strlen(input); i < sl; i++)
                {
                if(input[i] >= 'A' && input[i] <= 'Z')
                {input[i] = ((((input[i]-'A') + k)) % 26) + 'A';}
                else if(input[i] >= 'a' && input[i] <= 'z')
                {input[i] = ((((input[i]-'a') + k)) % 26) + 'a';}
            }
    
   printf("%s\n", input);
    
    

}
