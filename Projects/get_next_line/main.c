/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   main.c                                             :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: jmondino <marvin@42.fr>                    +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/01/07 14:16:03 by jmondino          #+#    #+#             */
/*   Updated: 2019/01/07 14:18:38 by jmondino         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include "get_next_line.h"

int		main(int ac, char **av)
{
	int fd;
	char *line;

	fd = open(av[1], O_RDONLY);

	while (get_next_line(fd, &line))
		printf("line = [%s]\n", line);
	return 0;
}
