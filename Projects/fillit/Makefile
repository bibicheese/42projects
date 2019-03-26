#******************************************************************************#
#                                                                              #
#                                                         :::      ::::::::    #
#    Makefile                                           :+:      :+:    :+:    #
#                                                     +:+ +:+         +:+      #
#    By: jmondino <marvin@42.fr>                    +#+  +:+       +#+         #
#                                                 +#+#+#+#+#+   +#+            #
#    Created: 2019/01/31 14:07:21 by jmondino          #+#    #+#              #
#    Updated: 2019/02/19 17:24:43 by jmondino         ###   ########.fr        #
#                                                                              #
#******************************************************************************#

NAME = fillit

SRC = misc.c\
	backtracking.c\
	check.c\
	checkform.c\
	create_ttrm.c\
	adaptation.c\
	place_ttrm.c\
	functions.c\
	functions2.c\
	functions3.c\
	get_next_line.c\
	main.c\

OBJ = $(SRC:.c=.o)

FLAGS = -Wextra -Wall -Werror

all:$(NAME)

$(NAME): $(OBJ)
	gcc $(FLAGS) -o $(NAME) $(OBJ)

clean:
	/bin/rm -f $(OBJ)

fclean: clean
	/bin/rm -f $(NAME)

re: fclean all
