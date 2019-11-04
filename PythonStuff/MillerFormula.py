def calculateMale():
    mheight = int(input("Please enter your height in inches.\n"))
    if mheight < 60:
        print("Sorry, you are too short for this program to be accurate.")
    else:
        mWeight = 56.2 + (1.41*(mheight - 60))
        mWeight *= 2.205
        print("Your ideal weight is " +str(round(mWeight,2))+ " lbs")

def calculateFemale():
    fheight = int(input("Please enter your height in inches.\n"))
    if fheight < 60:
        print("Sorry, you are too short for this program to be accurate.")
    else:
        fWeight = 53.1 + (1.36*(fheight - 60))
        fWeight *= 2.205
        print("Your ideal weight is " +str(round(fWeight,2))+ " lbs")


def main():

    print("\nThis is a program to calculate the ideal weight of a person that is over 5ft tall.")
    choice = input("Please enter 'M' for Male and 'F' for Female:\n")
    if choice == "m" or choice == "M" or choice == "Male":
        calculateMale()
    elif choice == "f" or choice == "F" or choice == "Female":
        calculateFemale()
    else:
        print("Please enter a valid option.")

main()
