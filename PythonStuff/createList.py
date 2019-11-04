# This function will only work with strings, 
# it cannot concatentate ints or numbers in general 
def createList(items):

    z = len(items)

    if z == 0:
        return print ("List is empty")

    if z == 1:
        return print (items[0])

    li = items[0]
    for item in items[1:-1]:
        li = li + ", " + item
    return print (li + ", and " + items[-1])

def main():
    spam = ['dogs', 'ice-cream', 'pool']
    createList(spam)

main()

    # The code below "attempts" to transform the list 
    # into a string but breaks it up to every individual letter

    # strSpam = ''.join(map(str, spam))
    # createlist(strSpam)
