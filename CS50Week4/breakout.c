//
// breakout.c
//
// Computer Science 50
// Problem Set 4
//

// standard libraries
#define _XOPEN_SOURCE
#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include <time.h>

// Stanford Portable Library
#include "gevents.h"
#include "gobjects.h"
#include "gwindow.h"

// height and width of game's window in pixels
#define HEIGHT 600
#define WIDTH 400

// height and width of game's paddle in pixels
#define PADHEIGHT 15
#define PADWIDTH 80

// height and width of game's boxes in pixels
#define BOXHEIGHT 10
#define BOXWIDTH 28

// number of rows of bricks
#define ROWS 5

// number of columns of bricks
#define COLS 10

// radius of ball in pixels
#define RADIUS 10

// score
#define LIVES 3

// prototypes
void initBricks(GWindow window);
GOval initBall(GWindow window);
GRect initPaddle(GWindow window);
GLabel initScoreboard(GWindow window);
void updateScoreboard(GWindow window, GLabel label, int points);
GObject detectCollision(GWindow window, GOval ball);

int main(void)
{
    // seed pseudorandom number generator
    srand48(time(NULL));

    // instantiate window
    GWindow window = newGWindow(WIDTH, HEIGHT);

    // instantiate bricks
    initBricks(window);

    // instantiate ball, centered in middle of window
    GOval ball = initBall(window);

    // instantiate paddle, centered at bottom of window
    GRect paddle = initPaddle(window);

    // instantiate scoreboard, centered in middle of window, just above ball
    GLabel label = initScoreboard(window);

    // number of bricks initially
    int bricks = COLS * ROWS;

    // number of lives initially
    int lives = LIVES;

    // number of points initially
    int points = 0;
    
    // set velocity for the ball
    double velx = drand48() * 5;
    double vely = drand48() * 5;

    // keep playing until game over
    while (lives > 0 && bricks > 0)
    {
        // check for mouse event
            GEvent event = getNextEvent(MOUSE_EVENT);
   // if we heard one
            if (event != NULL)
            {
            // if the event was movement
                if (getEventType(event) == MOUSE_MOVED)
                {
                // ensure ball follows top cursor
                    double x = getX(event) - PADWIDTH / 2;
                    double y = (HEIGHT - 30);
                    setLocation(paddle, x, y);
                }
            }
        
        // move ball along x-axis
        move(ball, velx, vely);
        // bounce off right edge of window
        if (getX(ball) + getWidth(ball) >= getWidth(window))
        {
            velx = -velx;
        }
        // bounce off left edge of window
            else if (getX(ball) <= 0)
            {
                velx = -velx;
            }
        
        // bounce off top edge of window
            else if (getY(ball) + getWidth(ball) >= getHeight(window))
            {
                lives--;
                double x = (getWidth(window) - (20/2)) / 2;
                double y = (getHeight(window) - (20/2)) / 2;
                setLocation(ball, x, y);
                waitForClick(); // THEN wait for click       
            }
        
        // bounce off bottom edge of window
            else if (getY(ball) <= 0)
            {
                vely = -vely; 
            }

        // linger before moving again
            pause(10);

        // check for collection
            GObject object = detectCollision(window, ball);
            if (object != NULL)
            {
                if (strcmp(getType(object), "GRect") == 0)
                {
                    if (object == paddle)
                    {
                        vely = -vely;
                    }
                    else if (strcmp(getType(object), "GRect") == 0)
                    {
                        vely = -vely;
                        void removeGWindow(GWindow window, GObject object);
                        removeGWindow(window, object);
                        points ++;
                        updateScoreboard(window, label, points);
                    }
                }
            }
        }
        

    // wait for click before exiting
    waitForClick();

    // game over
    closeGWindow(window);
    return 0;
}

/**
 * Initializes window with a grid of bricks.
 */
void initBricks(GWindow window)
{
    int hspace = 10;
	int lspace = 10;
    for(int row = 0; row < ROWS; row++) 
	{
	    
        for(int colums = 0; colums < COLS; colums++)
        {
            double x = hspace;
            double y = lspace;
            GRect block = newGRect(x, y, BOXWIDTH, BOXHEIGHT);
            setFilled(block, true);
            add(window, block);
            hspace = hspace + BOXWIDTH + 10;
        }
        hspace = 10;
        lspace = lspace + BOXHEIGHT + 8;
}
}
/**
 * Instantiates ball in center of window.  Returns ball.
 */
GOval initBall(GWindow window)
{
    double x = (getWidth(window) - (20/2)) / 2;
    double y = (getHeight(window) - (20/2)) / 2;
    GOval ball = newGOval(x, y, RADIUS, RADIUS);
    setColor(ball, "BLACK");
    setFilled(ball, true);
    add(window, ball);
    return ball;
}

/**
 * Instantiates paddle in bottom-middle of window.
 */
GRect initPaddle(GWindow window)
{
    double x = (getWidth(window) - (PADWIDTH/2)) / 2;
    double y = (HEIGHT - 30);
    GRect paddle = newGRect(x, y, PADWIDTH, PADHEIGHT);
    setFilled(paddle, true);
    add(window, paddle);
    
    return paddle;
}

/**
 * Instantiates, configures, and returns label for scoreboard.
 */
GLabel initScoreboard(GWindow window)
{
    GLabel label = newGLabel("");
    setFont(label, "SansSerif-18");
    double x = HEIGHT / 2;
    double y = WIDTH / 2;
    setLocation(label, x, y);
    add(window, label);
    updateScoreboard(window, label, 0);
    return label;
}

/**
 * Updates scoreboard's label, keeping it centered in window.
 */
void updateScoreboard(GWindow window, GLabel label, int points)
{
    // update label
    char s[12];
    sprintf(s, "%i", points);
    setLabel(label, s);

    // center label in window
    double x = (getWidth(window) - getWidth(label)) / 2;
    double y = (getHeight(window) - getHeight(label)) / 2;
    setLocation(label, x, y);
}

/**
 * Detects whether ball has collided with some object in window
 * by checking the four corners of its bounding box (which are
 * outside the ball's GOval, and so the ball can't collide with
 * itself).  Returns object if so, else NULL.
 */
GObject detectCollision(GWindow window, GOval ball)
{
    // ball's location
    double x = getX(ball);
    double y = getY(ball);

    // for checking for collisions
    GObject object;

    // check for collision at ball's top-left corner
    object = getGObjectAt(window, x, y);
    if (object != NULL)
    {
        return object;
    }

    // check for collision at ball's top-right corner
    object = getGObjectAt(window, x + 2 * RADIUS, y);
    if (object != NULL)
    {
        return object;
    }

    // check for collision at ball's bottom-left corner
    object = getGObjectAt(window, x, y + 2 * RADIUS);
    if (object != NULL)
    {
        return object;
    }

    // check for collision at ball's bottom-right corner
    object = getGObjectAt(window, x + 2 * RADIUS, y + 2 * RADIUS);
    if (object != NULL)
    {
        return object;
    }

    // no collision
    return NULL;
}
