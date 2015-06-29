#include <cs50.h>
#include <stdio.h>
#include <math.h>

int main(void)
{
// A do/while loop is used first to collect and validate the user input
    float n;
    do
    {
    printf("How much change is owed?:\n");
    n = GetFloat();
    }
    while (n < .009);

// Convert the floating point input into a integer    
    int newnumber = round(n*100);
    
    
    int coins = 0;
    
    while(newnumber >= 25)
    {
    newnumber -= 25;
    coins += 1;
    }
    while (newnumber >= 10)
    {
    newnumber -= 10;
    coins += 1;
    }
    while (newnumber >= 5)
    {
    newnumber -= 5;
    coins += 1;
    }
    while (newnumber >= 1)
    {
    newnumber -= 1;
    coins +=1;
    }
    
    printf("%d\n", coins);
    }
    
    
 
