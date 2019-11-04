def lookUpCourse(coursesList):
    print("\nPlease choose a course from the list to get more information from.\n")
    for key in coursesList:
        print (key)
    choice = input("\n")
    if choice in coursesList:
        print("\nThe description for " + choice + " is " + coursesList.get(choice))
    else:
        print("\n" + choice + " doesn't exist.")

def addCourse(coursesList):
    classNumber = input("\nPlease enter the course number for the new class:\n")
    if classNumber not in coursesList:
        classDescription = input("\nPlease enter the course description:\n")
        coursesList[classNumber] = classDescription
        print("\nNew Course List")
        for k, v in coursesList.items():
            print('{}: {}'.format(k, v))
    else:
        print("\nThis class already exists in our system.")

def redefineCourse(coursesList):
    for key in coursesList:
        print (key)
    classNumber = input("\nPlease enter the course number from the list above that you wish to edit: \n")
    classDescription = input("\nPlease enter the course description: \n")
    print("\nUpdated Course List")
    updatedInfo = {classNumber:classDescription}
    coursesList.update(updatedInfo)
    for k, v in coursesList.items():
        print('{}: {}'.format(k, v))

def deleteCourse(coursesList):
    print("Please choose a course from the list to remove\n")
    for key in coursesList:
        print (key)
    courseToBeRemoved = input("\n")
    if courseToBeRemoved in coursesList:
        del coursesList[courseToBeRemoved]
        print("\nUpdated Course List after Removal")
        for k, v in coursesList.items():
            print('{}: {}'.format(k, v))
    else:
        print("\nThere is no course with that name here.")

def main():
    courses = {"CPS 1231": "Foundations of Computer Science",
               "CPS 2231": "Computer Organization & Programming",
               "CPS 2232": "Data Structure",
               "CPS 3250": "Computer Operating Systems",
               "CPS 3351": "Information Systems Programmming",
               "CPS 3440": "Advanced Algorithms and Complexity Theory",
               "CPS 3500": "Programming the World Wide Web",
               "CPS 3740": "Database Management",
               "CPS 3962": "Object Oriented Analysis & Design",
               "CPS 4200": "Systems Programming",
               "CPS 4222": "Principles of Networking",
               "CPS 4931": "Distributed Systems Applications"
               }
    
    print("\nProgram for viewing and altering the Kean Univsersity Computer Science Courses.")
    choice = input("\n 0 = Quit \n 1 = Look up a class \n 2 = Add a Class \n 3 = Redefine a class \n 4 = Delete a class \n\n")
    while choice != "0":
        if choice == "1":
            lookUpCourse(courses)
            break
        elif choice == "2":
            addCourse(courses)
            break
        elif choice == "3":
            redefineCourse(courses)
            break
        elif choice == "4":
            deleteCourse(courses)
            break
        else:
            print ("Please make a valid choice next time.")
            break

main()

