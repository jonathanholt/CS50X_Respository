#include <cs50.h>
#include <stdio.h>

int main(void)
{
// A do/while loop is used first to collect and validate the user input
    int n;
    do
    {
    printf("Height:\n");
    n = GetInt();
    }
    while (n > 23 || n < 0);
    
    
// Next we will use a number of imbedded for loops. The first loop keeps track of the number of rows,
// while the next two loops print the correct number of spaces and blocks, respectively.    
    for(int row = 0; row < n; row++) 
	{
        for(int spaces = 0; spaces < n-row-1; spaces++)
        {
            printf(" ");
        }
		for(int block = 0; block < row+2; block++)
		{
			printf("#");
		}
		printf("\n");
	}	
	return 0;
	}
