#include <stdio.h>
#include <string.h>

struct Person
{
    int ID;
    char fname[6];
    char lname[9];
    char bday[2];
    char bmonth[2];
    char byear[4];
};

int main(){

    struct Person p1 = {.ID = 807198,
                        .fname = "Bryant",
                        .lname = "Mondragon",
                        .bmonth = "06",
                        .bday = "08",
                        .byear = "1993"
                        };

    void *baseptr;

    asm("movl %%ebp, %0;"
            :"=r"(baseptr)
        );

    // void *stackptr;

    // asm( "movl %%esp, %0;" 
    //         : "=rm" (stackptr)
    //     );

    
    // printf("The value of stackpointer main: \n");
    // printf("%p\n", stackptr);

    printf("The value of basepointer main: \n");
    printf("%p\n", baseptr);

    printf( "ID: %d\n", p1.ID);
    printf( "First Name: %.6s\n", p1.fname);
    printf( "Last Name: %.9s\n", p1.lname);
    printf( "Birth Day: %.2s\n", p1.bday);
    printf( "Birth Month: %.2s\n", p1.bmonth);
    printf( "Birth Year: %.4s\n", p1.byear);

    printPerson(p1, baseptr); 

    return 0;
}

void printPerson(struct Person p2, void* baseptr)
{
    void *baseptr1;

    asm("movl %%ebp, %0;"
            :"=r"(baseptr1)
        );
    
    printf( "The value of basepointer print is: \n");
    printf( "%p\n", baseptr1);
    printf( "The value at basepointer address is: \n");
    printf( "%x\n", baseptr);
    printf( "Address of ID: %p\n", &p2.ID);
    printf( "Address of First Name: %p\n", p2.fname);
    printf( "Address of Last Name: %p\n", p2.lname);
    printf( "Address of Birth Day: %p\n", p2.bday);
    printf( "Address of Birth Month: %p\n", p2.bmonth);
    printf( "Address of Birth Year: %p\n", p2.byear);
    printf( "The address of my birth day and month is at address: %x\n", p2.bday);

    char buffer[4];
    sprintf(buffer, "%x%x%x%x",p2.bday[3],p2.bday[2],p2.bday[1],p2.bday[0]);
    int n = strtol(buffer, NULL, 16);

    printf( "The integer value of my birth day and month is: %d\n",n);
}


