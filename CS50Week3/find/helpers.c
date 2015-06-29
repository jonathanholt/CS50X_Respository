/**
 * helpers.c
 *
 * Computer Science 50
 * Problem Set 3
 *
 * Helper functions for Problem Set 3.
 */
       
#include <cs50.h>
#include <stdio.h>
#include "helpers.h"
 

 // Returns true if value is in array of n values, else false.
bool search(int value, int values[], int n)
{
    sort(values, n);
    if (value > values[n-1] || value < values[0])
    {
    return false;
    }
    int first = values[0];
    int last = values[n-1];
    int mid = (last + first)/2;
    
    while (values[mid])
    {
        printf("%d\n", mid);
        if (value > mid)
            first = mid + 1;
        else if (value == mid)
            return true;
        else
            last = mid;
        mid = (last + first)/2;
    }
    return 1;
    }



/**
    int first = values[0];
    int last = values[n-1];
    int mid;
    
    while (first <= last)
    {
    if (values[mid] == value)
    {
    return true;
    }
    else if (values[mid] < value)
    {
    first = mid + 1;
    }
    else
    {
    last = mid - 1;
    }}
    return false;
    }
    
     implement a searching algorithm
    int count = 0;
    if (n >= 0)
    {
        for (int i = 0; values[i] != '\0'; i++)
        {
            count ++;
        }
        for (int i = 0; i < count; i++)
        {   
            if (values[i] == value) { return true; }
        }
    }
    return false;
} */

 
void sort(int values[], int n)
{
     int store;
     int min;
    // TODO: implement an O(n^2) sorting algorithm
     for (int i = 0; i < n; i++)
    {
    min = i;
    for (int j = i + 1; j < n; j++)
    {
    if (values[j] < values[min])
    {
    min = j;
    }}
    store = values[i];
    values[i] = values[min];
    values[min] = store;
    }
  
    return;
}

