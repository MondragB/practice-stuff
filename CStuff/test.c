#include <stdio.h>
#include <string.h>

int main(){

    int ID = 807198;
    char fname[] = "Bryant";
    char lname[] = "Mondragon";
    char bmonth[] =  "01";
    char bday[] = "07";
    char byear[] = "1993";

    void *baseptr;

    asm("movl %%ebp, %0;"
            :"=r"(baseptr)
        );
    
    printf("The value of basepointer main: \n");
    printf("%p\n", baseptr);

    printf( "ID: %d\n", ID);
    printf( "First Name: %s\n", fname);
    printf( "Last name: %s\n", lname);
    printf( "Birth Month: %s\n", bmonth);
    printf( "Birth Day: %s\n", bday);
    printf( "Birth Year: %s\n", byear);

    printPerson(&ID, &fname, &lname, &bmonth, &bday, &byear, baseptr);

    return 0;
}

void printPerson(int *ID,char *fname, char *lname, char *bmonth, char *bday, char *byear, void *baseptr)
{
    void *baseptr1;

    asm("movl %%ebp, %0;"
            :"=r"(baseptr1)
        );

    printf("The value of basepointer print is: \n");
    printf("%p\n", baseptr1);
    printf("The value at basepointer address is: \n");
    printf("%x\n", baseptr);
    printf( "Address of ID: %p\n", ID);
    printf( "Address of First Name: %p\n", fname);
    printf( "Address of Last name: %p\n", lname);
    printf( "Address of Birth Month: %p\n", bmonth);
    printf( "Address of Birth Day: %p\n", bday);
    printf( "Address of Birth Year: %p\n", byear);
    
    int a = strcat(bmonth, bday);
    printf("%s\n", bmonth);
    printf( "The address of my birthday and month is at address:%x\n", bmonth);
    printf("The integer value of my birth day and month is:%u\n", bmonth);
}

