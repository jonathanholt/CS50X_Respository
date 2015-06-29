/**
 * recover.c
 *
 * Computer Science 50
 * Problem Set 5
 *
 * Recovers jpeg from a wiped SD card
 */

#include <stdio.h>
#include <stdlib.h>
#include <stdint.h>
#include <string.h>

int main(void)
{
		// Open our target folder and check the contents
   	 	FILE* file = fopen("card.raw", "r");
    	
    	if(file == NULL)
		{	
				fclose(file);
				fprintf(stderr, "Wasn't able to open the cardfile.\n");
				return 1;
		}

    	// Establish useful variables, including our buffer, a counter for filenames and a boolean value
    	uint8_t checkjpg1[4] = {0xff, 0xd8, 0xff, 0xe0};
    	uint8_t checkjpg2[4] = {0xff, 0xd8, 0xff, 0xe1};
    
 	    uint8_t buffer[512];
 	    uint8_t check[4];

 	    int num = 0;
 	    int current = 0;
 	    FILE* img;
	
 	    fread(buffer, 512, 1, file);
 	
 	    while (fread(buffer, 512, 1, file) > 0)
 	    {
  	        	// Add first four bytes into the check buffer
				for(int i = 0; i < 4; i++)
				{
						check[i] = buffer[i];
				}

				// Check if the bytes represent the start of a new JPEG file
				if ((check[0] == checkjpg1[0] && check[1] == checkjpg1[1]) || (check[0] == checkjpg2[0] && check[1]== checkjpg2[1]))
				{
                    	char title[8];
                        sprintf(title, "%03d.jpg", num);
                    
                        if (current == 0)
                        {
                    		    img = fopen(title, "w");
                                fwrite(buffer, sizeof(buffer), 1, img);
                                current = 1;
                        } 
                        if (current == 1)
                        {
                             	fclose(img);
                         	    img = fopen(title, "w");
                         	    fwrite(buffer, sizeof(buffer), 1, img);
                             	num ++;
                        }
                }    
                else
                {
                     	if(current == 1)
				     	{
						     	fwrite(buffer, sizeof(buffer), 1, img);
				        }
                }
        }
        
    // Close everything
    if(img)
    {
      fclose(img);
    }

        fclose(file);
	    return 0;
} 
