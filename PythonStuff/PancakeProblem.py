def minutesNeeded(x, y, z):

    halfCap = x//2
    remainder = y%x
    equalToTime = (y//x)*z

    if (y <= x):
        print("The time to cook", y, "Pancake(s) with a capacity of", x, "is 10 mins")
    else:
        if (remainder==0):
            print("The time to cook", y, "Pancake(s) with a capacity of", x, "is", equalToTime, "mins")
        elif (remainder <= halfCap):
            newTime = equalToTime + 5
            print("The time to cook", y, "Pancake(s) with a capacity of", x, "is", newTime, "mins")
        else: 
            newTime = equalToTime + 10
            print("The time to cook", y, "Pancake(s) with a capacity of", x, "is", newTime, "mins")

def main():

    capacity = int(input("Please enter the capacity of pancakes for the oven:\n"))
    numPancakes = int(input("Please enter the number of Pancakes you would like to cook:\n"))
    cookingTime = 10

    minutesNeeded(capacity, numPancakes, cookingTime)

main()