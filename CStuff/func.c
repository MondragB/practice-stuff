#include <stdio.h>
#include "main.h"

void printPerson(int *ID,char *fname, char *lname, char *bmonth, char *bday, char *byear, void *baseptr)
{
    void *baseptr;

    // asm("movl %%ebp, %0;"
    //         :"=r"(baseptr)
    //     );

    printf("The value of basepointer print is: \n");
    printf("%p\n", baseptr);

    printf( "Address of ID: %p\n", ID);
    printf( "Address of First Name: %p\n", fname);
    printf( "Address of Last name: %p\n", lname);
    printf( "Address of Birth Month: %p\n", bmonth);
    printf( "Address of Birth Day: %p\n", bday);
    printf( "Address of Birth Year: %p\n", byear);
}