#include <stdio.h>
#include <string.h>
#include "func.c"

int main(){

    MyPerson person1;

    void *baseptr;

    // asm("movl %%ebp, %0;"
    //         :"=r"(baseptr)
    //     );
    
    printf("The value of basepointer main: \n");
    printf("%p\n", baseptr);
    
    person1.ID = 807198;
    strcpy(person1.fname, "Bryant");
    strcpy(person1.lname, "Mondragon");
    strcpy(person1.bmonth, "06");
    strcpy(person1.bday, "08");
    strcpy(person1.byear, "1993");

    printf( "ID: %d\n", person1.ID);
    printf( "First Name: %s\n", person1.fname);
    printf( "Last name: %s\n", person1.lname);
    printf( "Birth Month: %s\n", person1.bmonth);
    printf( "Birth Day: %s\n", person1.bday);
    printf( "Birth Year: %s\n", person1.byear);

    printPerson(&ID, &fname, &lname, &bmonth, &bday, &byear, baseptr);

    return 0;
}

