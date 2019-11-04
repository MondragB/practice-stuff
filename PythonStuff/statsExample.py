import math
from collections import Counter

def mean(nums):
	sum = 0.0
	for num in nums:
		sum = sum + num
	return sum / len(nums)

def stdDev(nums, xbar):
	sumDevSq = 0.0
	for num in nums:
		dev = xbar - num
		sumDevSq = sumDevSq + dev * dev
	return math.sqrt(sumDevSq/(len(nums)-1))

def median(nums):
	nums.sort()
	size = len(nums)
	midPos = round(size / 2)
	if size % 2 == 0:
		median = (nums[midPos] + nums[midPos-1]) / 2.0
	else:
		median = nums[midPos]
	return median


def main():
	print ("This program computes mean, median, and standard deviation.")
	data = [3,6,7,2,8,9,2,3,7,4,5,9,2,1,6,9,6]
	xbar = mean(data)
	std = stdDev(data, xbar)
	med = median(data)
	print ("The mean is", xbar)
	print ("The standard deviation is", std)
	print ("The median is", med)

	# This coverts the list into a dictionary and using the Counter function from collections it will record each unique char and counts the amount of times it appears as follows: 
	# ("first index":"number of times it appears", "etc":"etc",... )
	duplicates = dict(Counter(data))
	print (duplicates)

main()

